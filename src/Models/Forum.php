<?php

declare(strict_types=1);

class Forum {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Obtiene una lista paginada de publicaciones con información del autor y contador de comentarios.
     *
     * @param int $limit Número de publicaciones a obtener
     * @param int $offset Desplazamiento para paginación
     * @param string|null $search Término de búsqueda en título, contenido o autor
     * @param int|null $userId Filtro por autor específico
     * @return array
     */
    public function getPosts(int $limit = 10, int $offset = 0, ?string $search = null, ?int $userId = null): array {
        $sql = "SELECT 
                    p.post_id,
                    p.user_id,
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
                    (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.post_id) AS comments_count
                FROM posts p
                INNER JOIN users u ON p.user_id = u.user_id
                INNER JOIN roles r ON u.role_id = r.role_id
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

        $sql .= " ORDER BY p.publication_date DESC, p.post_id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cuenta el total de publicaciones según los filtros aplicados (para metadatos de paginación).
     *
     * @param string|null $search
     * @param int|null $userId
     * @return int
     */
    public function countPosts(?string $search = null, ?int $userId = null): int {
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

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    /**
     * Obtiene el detalle de un post específico por su ID junto a los datos del autor.
     *
     * @param int $postId
     * @return array|null
     */
    public function getPostById(int $postId): ?array {
        $sql = "SELECT 
                    p.post_id,
                    p.user_id,
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
                    (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.post_id) AS comments_count
                FROM posts p
                INNER JOIN users u ON p.user_id = u.user_id
                INNER JOIN roles r ON u.role_id = r.role_id
                WHERE p.post_id = :post_id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':post_id' => $postId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    /**
     * Crea una nueva publicación en la base de datos.
     *
     * @param array $data ['user_id', 'title', 'content', 'file_url', 'file_type', 'external_link']
     * @return int ID de la publicación creada
     */
    public function createPost(array $data): int {
        $sql = "INSERT INTO posts 
                (user_id, title, content, file_url, file_type, external_link, publication_date)
                VALUES 
                (:user_id, :title, :content, :file_url, :file_type, :external_link, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user_id'       => (int) $data['user_id'],
            ':title'         => trim((string) $data['title']),
            ':content'       => trim((string) $data['content']),
            ':file_url'      => !empty($data['file_url']) ? trim((string) $data['file_url']) : null,
            ':file_type'     => !empty($data['file_type']) ? trim((string) $data['file_type']) : null,
            ':external_link' => !empty($data['external_link']) ? trim((string) $data['external_link']) : null,
        ]);

        return (int) $this->db->lastInsertId();
    }

    /**
     * Actualiza el título, contenido o enlaces/adjuntos de una publicación existente.
     *
     * @param int $postId
     * @param array $data
     * @return bool
     */
    public function updatePost(int $postId, array $data): bool {
        $fields = [];
        $params = [':post_id' => $postId];

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
     * Elimina una publicación (los comentarios asociados se eliminan en cascada en la BD).
     *
     * @param int $postId
     * @return bool
     */
    public function deletePost(int $postId): bool {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE post_id = :post_id");
        return $stmt->execute([':post_id' => $postId]);
    }

    /**
     * Obtiene todos los comentarios asociados a una publicación, ordenados cronológicamente.
     *
     * @param int $postId
     * @return array
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
     *
     * @param int $commentId
     * @return array|null
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
     *
     * @param int $postId
     * @param int $userId
     * @param string $commentText
     * @return int ID del comentario creado
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
     *
     * @param int $commentId
     * @return bool
     */
    public function deleteComment(int $commentId): bool {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
        return $stmt->execute([':comment_id' => $commentId]);
    }
}
