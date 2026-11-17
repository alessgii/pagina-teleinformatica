<?php

declare(strict_types=1);

class Forum {
    public const VALID_CATEGORIES = ['general', 'electronica', 'sistemas', 'programacion', 'redes'];

    private PDO $db;
    private static bool $schemaChecked = false;

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->ensureSchema();
    }

    /**
     * Garantiza que las columnas y tablas nuevas (category y post_likes) existan
     * incluso en bases de datos locales creadas con una versión previa de intel-db.sql.
     */
    private function ensureSchema(): void {
        if (self::$schemaChecked) {
            return;
        }
        self::$schemaChecked = true;

        try {
            $colCheck = $this->db->query("SHOW COLUMNS FROM posts LIKE 'category'");
            if ($colCheck && $colCheck->rowCount() === 0) {
                $this->db->exec("
                    ALTER TABLE posts 
                    ADD COLUMN category ENUM('general', 'electronica', 'sistemas', 'programacion', 'redes') 
                    NOT NULL DEFAULT 'general' AFTER user_id
                ");
            }

            $this->db->exec("
                CREATE TABLE IF NOT EXISTS post_likes (
                    post_id INT NOT NULL,
                    user_id INT NOT NULL,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (post_id, user_id),
                    CONSTRAINT fk_likes_post FOREIGN KEY (post_id) 
                        REFERENCES posts(post_id) ON DELETE CASCADE,
                    CONSTRAINT fk_likes_user FOREIGN KEY (user_id) 
                        REFERENCES users(user_id) ON DELETE CASCADE
                ) ENGINE = InnoDB
            ");
        } catch (\Throwable $e) {
            // Si el usuario de BD no tiene permisos DDL, continúa sin interrumpir
        }
    }

    /**
     * Normaliza una categoría contra las permitidas.
     */
    public static function normalizeCategory(?string $category): string {
        $clean = strtolower(trim((string) $category));
        return in_array($clean, self::VALID_CATEGORIES, true) ? $clean : 'general';
    }

    /**
     * Obtiene una lista paginada de publicaciones con información del autor, categoría, likes y comentarios.
     */
    public function getPosts(
        int $limit = 10,
        int $offset = 0,
        ?string $search = null,
        ?int $userId = null,
        ?string $category = null,
        bool $onlyWithResources = false,
        ?int $viewerUserId = null
    ): array {
        $likedSelect = ($viewerUserId !== null && $viewerUserId > 0)
            ? "EXISTS(SELECT 1 FROM post_likes pl_me WHERE pl_me.post_id = p.post_id AND pl_me.user_id = :viewer_user_id) AS user_liked"
            : "0 AS user_liked";

        $sql = "SELECT 
                    p.post_id,
                    p.user_id,
                    p.category,
                    p.title,
                    p.content,
                    p.file_url,
                    p.file_type,
                    p.external_link,
                    p.publication_date,
                    u.full_name AS author_name,
                    u.institutional_email AS author_email,
                    r.role_id,
                    r.role_name,
                    (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.post_id) AS comments_count,
                    (SELECT COUNT(*) FROM post_likes pl WHERE pl.post_id = p.post_id) AS likes_count,
                    {$likedSelect}
                FROM posts p
                INNER JOIN users u ON p.user_id = u.user_id
                INNER JOIN roles r ON u.role_id = r.role_id
                WHERE 1=1";

        $params = [];

        if ($viewerUserId !== null && $viewerUserId > 0) {
            $params[':viewer_user_id'] = $viewerUserId;
        }

        if (!empty($search)) {
            $sql .= " AND (p.title LIKE :search_title OR p.content LIKE :search_content OR u.full_name LIKE :search_author)";
            $term = '%' . $search . '%';
            $params[':search_title'] = $term;
            $params[':search_content'] = $term;
            $params[':search_author'] = $term;
        }

        if ($userId !== null && $userId > 0) {
            $sql .= " AND p.user_id = :user_id";
            $params[':user_id'] = $userId;
        }

        if (!empty($category) && in_array(strtolower($category), self::VALID_CATEGORIES, true)) {
            $sql .= " AND p.category = :category";
            $params[':category'] = strtolower($category);
        }

        if ($onlyWithResources) {
            $sql .= " AND (p.file_url IS NOT NULL OR p.external_link IS NOT NULL)";
        }

        $sql .= " ORDER BY p.publication_date DESC, p.post_id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as &$row) {
            $row['comments_count'] = (int) ($row['comments_count'] ?? 0);
            $row['likes_count']    = (int) ($row['likes_count'] ?? 0);
            $row['user_liked']     = (bool) ($row['user_liked'] ?? false);
        }

        return $rows;
    }

    /**
     * Cuenta el total de publicaciones según los filtros aplicados (para metadatos de paginación).
     */
    public function countPosts(
        ?string $search = null,
        ?int $userId = null,
        ?string $category = null,
        bool $onlyWithResources = false
    ): int {
        $sql = "SELECT COUNT(*) FROM posts p 
                INNER JOIN users u ON p.user_id = u.user_id 
                WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (p.title LIKE :search_title OR p.content LIKE :search_content OR u.full_name LIKE :search_author)";
            $term = '%' . $search . '%';
            $params[':search_title'] = $term;
            $params[':search_content'] = $term;
            $params[':search_author'] = $term;
        }

        if ($userId !== null && $userId > 0) {
            $sql .= " AND p.user_id = :user_id";
            $params[':user_id'] = $userId;
        }

        if (!empty($category) && in_array(strtolower($category), self::VALID_CATEGORIES, true)) {
            $sql .= " AND p.category = :category";
            $params[':category'] = strtolower($category);
        }

        if ($onlyWithResources) {
            $sql .= " AND (p.file_url IS NOT NULL OR p.external_link IS NOT NULL)";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    /**
     * Obtiene el conteo real de publicaciones por cada categoría.
     */
    public function getCategoryCounts(): array {
        $counts = array_fill_keys(self::VALID_CATEGORIES, 0);
        $stmt = $this->db->query("SELECT category, COUNT(*) AS total FROM posts GROUP BY category");
        if ($stmt) {
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $cat = strtolower((string) ($row['category'] ?? ''));
                if (isset($counts[$cat])) {
                    $counts[$cat] = (int) $row['total'];
                }
            }
        }
        return $counts;
    }

    /**
     * Obtiene el detalle de un post específico por su ID junto a los datos del autor, likes y comentarios.
     */
    public function getPostById(int $postId, ?int $viewerUserId = null): ?array {
        $likedSelect = ($viewerUserId !== null && $viewerUserId > 0)
            ? "EXISTS(SELECT 1 FROM post_likes pl_me WHERE pl_me.post_id = p.post_id AND pl_me.user_id = :viewer_user_id) AS user_liked"
            : "0 AS user_liked";

        $sql = "SELECT 
                    p.post_id,
                    p.user_id,
                    p.category,
                    p.title,
                    p.content,
                    p.file_url,
                    p.file_type,
                    p.external_link,
                    p.publication_date,
                    u.full_name AS author_name,
                    u.institutional_email AS author_email,
                    r.role_id,
                    r.role_name,
                    (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.post_id) AS comments_count,
                    (SELECT COUNT(*) FROM post_likes pl WHERE pl.post_id = p.post_id) AS likes_count,
                    {$likedSelect}
                FROM posts p
                INNER JOIN users u ON p.user_id = u.user_id
                INNER JOIN roles r ON u.role_id = r.role_id
                WHERE p.post_id = :post_id
                LIMIT 1";

        $params = [':post_id' => $postId];
        if ($viewerUserId !== null && $viewerUserId > 0) {
            $params[':viewer_user_id'] = $viewerUserId;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $result['comments_count'] = (int) ($result['comments_count'] ?? 0);
        $result['likes_count']    = (int) ($result['likes_count'] ?? 0);
        $result['user_liked']     = (bool) ($result['user_liked'] ?? false);

        return $result;
    }

    /**
     * Crea una nueva publicación en la base de datos.
     */
    public function createPost(array $data): int {
        $category = self::normalizeCategory($data['category'] ?? 'general');

        $sql = "INSERT INTO posts 
                (user_id, category, title, content, file_url, file_type, external_link, publication_date)
                VALUES 
                (:user_id, :category, :title, :content, :file_url, :file_type, :external_link, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user_id'       => (int) $data['user_id'],
            ':category'      => $category,
            ':title'         => trim((string) $data['title']),
            ':content'       => trim((string) $data['content']),
            ':file_url'      => !empty($data['file_url']) ? trim((string) $data['file_url']) : null,
            ':file_type'     => !empty($data['file_type']) ? trim((string) $data['file_type']) : null,
            ':external_link' => !empty($data['external_link']) ? trim((string) $data['external_link']) : null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Actualiza una publicación existente.
     */
    public function updatePost(int $postId, array $data): bool {
        $fields = [];
        $params = [':post_id' => $postId];

        if (array_key_exists('category', $data)) {
            $fields[] = 'category = :category';
            $params[':category'] = self::normalizeCategory((string) $data['category']);
        }

        if (array_key_exists('title', $data)) {
            $fields[] = 'title = :title';
            $params[':title'] = trim((string) $data['title']);
        }

        if (array_key_exists('content', $data)) {
            $fields[] = 'content = :content';
            $params[':content'] = trim((string) $data['content']);
        }

        if (array_key_exists('file_url', $data)) {
            $fields[] = 'file_url = :file_url';
            $params[':file_url'] = !empty($data['file_url']) ? trim((string) $data['file_url']) : null;
        }

        if (array_key_exists('file_type', $data)) {
            $fields[] = 'file_type = :file_type';
            $params[':file_type'] = !empty($data['file_type']) ? trim((string) $data['file_type']) : null;
        }

        if (array_key_exists('external_link', $data)) {
            $fields[] = 'external_link = :external_link';
            $params[':external_link'] = !empty($data['external_link']) ? trim((string) $data['external_link']) : null;
        }

        if (empty($fields)) {
            return false;
        }

        $sql = "UPDATE posts SET " . implode(', ', $fields) . " WHERE post_id = :post_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Alterna el voto ("Útil / Me gusta") de un usuario sobre una publicación.
     *
     * @return array ['liked' => bool, 'likes_count' => int]
     */
    public function toggleLike(int $postId, int $userId): array {
        $checkStmt = $this->db->prepare("SELECT 1 FROM post_likes WHERE post_id = :post_id AND user_id = :user_id LIMIT 1");
        $checkStmt->execute([
            ':post_id' => $postId,
            ':user_id' => $userId,
        ]);
        $exists = (bool) $checkStmt->fetchColumn();

        if ($exists) {
            $delStmt = $this->db->prepare("DELETE FROM post_likes WHERE post_id = :post_id AND user_id = :user_id");
            $delStmt->execute([
                ':post_id' => $postId,
                ':user_id' => $userId,
            ]);
            $liked = false;
        } else {
            $insStmt = $this->db->prepare("INSERT INTO post_likes (post_id, user_id, created_at) VALUES (:post_id, :user_id, NOW())");
            $insStmt->execute([
                ':post_id' => $postId,
                ':user_id' => $userId,
            ]);
            $liked = true;
        }

        $countStmt = $this->db->prepare("SELECT COUNT(*) FROM post_likes WHERE post_id = :post_id");
        $countStmt->execute([':post_id' => $postId]);
        $likesCount = (int) $countStmt->fetchColumn();

        return [
            'liked'       => $liked,
            'likes_count' => $likesCount,
        ];
    }

    /**
     * Elimina una publicación (los comentarios y likes asociados se eliminan en cascada en la BD).
     */
    public function deletePost(int $postId): bool {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE post_id = :post_id");
        return $stmt->execute([':post_id' => $postId]);
    }

    /**
     * Obtiene todos los comentarios asociados a una publicación, ordenados cronológicamente.
     */
    public function getCommentsByPostId(int $postId): array {
        $sql = "SELECT 
                    c.comment_id,
                    c.post_id,
                    c.user_id,
                    c.comment_text,
                    c.comment_date,
                    u.full_name AS author_name,
                    u.institutional_email AS author_email,
                    r.role_id,
                    r.role_name
                FROM comments c
                INNER JOIN users u ON c.user_id = u.user_id
                INNER JOIN roles r ON u.role_id = r.role_id
                WHERE c.post_id = :post_id
                ORDER BY c.comment_date ASC, c.comment_id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':post_id' => $postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene un comentario por su ID.
     */
    public function getCommentById(int $commentId): ?array {
        $sql = "SELECT 
                    c.comment_id,
                    c.post_id,
                    c.user_id,
                    c.comment_text,
                    c.comment_date,
                    u.full_name AS author_name,
                    r.role_id,
                    r.role_name
                FROM comments c
                INNER JOIN users u ON c.user_id = u.user_id
                INNER JOIN roles r ON u.role_id = r.role_id
                WHERE c.comment_id = :comment_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':comment_id' => $commentId]);
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);

        return $comment ?: null;
    }

    /**
     * Agrega un nuevo comentario a una publicación.
     */
    public function createComment(int $postId, int $userId, string $commentText): int {
        $sql = "INSERT INTO comments (post_id, user_id, comment_text, comment_date)
                VALUES (:post_id, :user_id, :comment_text, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':post_id'      => $postId,
            ':user_id'      => $userId,
            ':comment_text' => trim($commentText),
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Elimina un comentario por su ID.
     */
    public function deleteComment(int $commentId): bool {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
        return $stmt->execute([':comment_id' => $commentId]);
    }
}
