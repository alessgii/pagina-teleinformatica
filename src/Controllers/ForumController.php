<?php

declare(strict_types=1);

require_once __DIR__ . '/../Middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../Models/Forum.php';

class ForumController {
    private Forum $forumModel;

    public function __construct(Forum $forumModel) {
        $this->forumModel = $forumModel;
    }

    /**
     * Responde en formato JSON estandarizado y finaliza la ejecución.
     */
    private function jsonResponse(int $statusCode, array $payload): void {
        http_response_code($statusCode);
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
        }
        echo json_encode($payload, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Parsea la entrada de la petición (JSON o $_POST).
     */
    private function parseInput(): array {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (str_contains($contentType, 'application/json')) {
            $rawInput = file_get_contents('php://input');
            $data = json_decode($rawInput, true);
            return is_array($data) ? $data : [];
        }

        // Si es formulario tradicional o multipart/form-data
        if (!empty($_POST)) {
            return $_POST;
        }

        // Fallback para PUT/PATCH con JSON crudo
        $rawInput = file_get_contents('php://input');
        if (!empty($rawInput)) {
            $data = json_decode($rawInput, true);
            if (is_array($data)) {
                return $data;
            }
        }

        return [];
    }

    /**
     * Determina si el usuario en sesión es administrador o coordinador (moderador).
     */
    private function isModerator(): bool {
        $roleId = AuthMiddleware::getRoleId();
        return $roleId !== null && in_array($roleId, [1, 2], true);
    }

    /**
     * Mapea una extensión de archivo a la categoría ENUM de la base de datos:
     * ('pdf', 'image', 'document', 'other')
     */
    private function mapExtensionToFileType(string $extension): string {
        $ext = strtolower($extension);
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'], true)) {
            return 'image';
        }
        if ($ext === 'pdf') {
            return 'pdf';
        }
        if (in_array($ext, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'], true)) {
            return 'document';
        }
        return 'other';
    }

    /**
     * Procesa la subida física de un archivo adjunto al servidor de forma segura.
     *
     * @param array $file Arreglo de $_FILES['file']
     * @return array [ 'file_url' => string, 'file_type' => string ]
     * @throws Exception Si el archivo no es válido o falla la subida
     */
    private function handleFileUpload(array $file): array {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error durante la subida del archivo adjunto (Código ' . $file['error'] . ').');
        }

        // Límite de tamaño: 10 MB
        $maxBytes = 10 * 1024 * 1024;
        if ($file['size'] > $maxBytes) {
            throw new Exception('El archivo adjunto supera el tamaño máximo permitido de 10 MB.');
        }

        $originalName = (string)($file['name'] ?? '');
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // Extensiones estrictamente prohibidas (ejecutables y scripts)
        $forbiddenExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phps', 'cgi', 'pl', 'exe', 'bat', 'cmd', 'sh', 'js', 'jar'];
        if (in_array($ext, $forbiddenExtensions, true) || empty($ext)) {
            throw new Exception('Tipo de archivo no permitido por motivos de seguridad.');
        }

        // Extensiones permitidas para la comunidad universitaria
        $allowedExtensions = ['pdf', 'png', 'jpg', 'jpeg', 'webp', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar', 'csv'];
        if (!in_array($ext, $allowedExtensions, true)) {
            throw new Exception('Formato de archivo no soportado. Extensiones admitidas: ' . implode(', ', $allowedExtensions));
        }

        $baseUploadDir = realpath(__DIR__ . '/../../public') ?: (__DIR__ . '/../../public');
        $targetDir = $baseUploadDir . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'forum';

        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0755, true) && !is_dir($targetDir)) {
                throw new Exception('No se pudo crear el directorio de subidas en el servidor.');
            }
        }

        // Nombre seguro y aleatorio para prevenir colisiones y directory traversal
        $safeFileName = date('Ymd_His') . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
        $destination = $targetDir . DIRECTORY_SEPARATOR . $safeFileName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception('No fue posible mover el archivo al directorio de almacenamiento.');
        }

        $relativeUrl = 'public/uploads/forum/' . $safeFileName;
        $fileType = $this->mapExtensionToFileType($ext);

        return [
            'file_url'  => $relativeUrl,
            'file_type' => $fileType,
            'file_name' => $originalName
        ];
    }

    // =========================================================================
    // ENDPOINTS DE PUBLICACIONES (posts)
    // =========================================================================

    /**
     * GET /api/posts
     * Listado público de publicaciones con paginación y búsqueda.
     */
    public function index(): void {
        try {
            $page = max(1, (int)($_GET['page'] ?? 1));
            $limit = min(50, max(1, (int)($_GET['limit'] ?? 10)));
            $offset = ($page - 1) * $limit;

            $search = isset($_GET['search']) ? trim((string)$_GET['search']) : null;
            if ($search === '') {
                $search = null;
            }

            $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
            if ($userId !== null && $userId <= 0) {
                $userId = null;
            }

            $posts = $this->forumModel->getPosts($limit, $offset, $search, $userId);
            $total = $this->forumModel->countPosts($search, $userId);
            $totalPages = $total > 0 ? (int)ceil($total / $limit) : 1;

            $this->jsonResponse(200, [
                'success'    => true,
                'data'       => $posts,
                'pagination' => [
                    'page'        => $page,
                    'limit'       => $limit,
                    'total'       => $total,
                    'total_pages' => $totalPages,
                ]
            ]);
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al obtener las publicaciones del foro: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * GET /api/me/posts
     * Publicaciones del usuario actualmente autenticado en sesión.
     */
    public function myPosts(): void {
        AuthMiddleware::requireApiAuth();
        $_GET['user_id'] = (string) AuthMiddleware::getUserId();
        $this->index();
    }

    /**
     * GET /api/posts/{id}
     * Detalle completo de una publicación individual.
     */
    public function show(int $id): void {
        try {
            $post = $this->forumModel->getPostById($id);

            if (!$post) {
                $this->jsonResponse(404, [
                    'success' => false,
                    'message' => "La publicación con ID {$id} no fue encontrada."
                ]);
            }

            $this->jsonResponse(200, [
                'success' => true,
                'data'    => $post
            ]);
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al consultar la publicación: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * POST /api/posts
     * Crea una nueva publicación (requiere autenticación).
     * Admite JSON o multipart/form-data con archivo adjunto.
     */
    public function store(): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $input = $this->parseInput();

        $title = trim((string)($input['title'] ?? ''));
        $content = trim((string)($input['content'] ?? ''));
        $externalLink = trim((string)($input['external_link'] ?? ''));
        $fileUrl = trim((string)($input['file_url'] ?? ''));
        $fileType = trim((string)($input['file_type'] ?? ''));

        // Validaciones
        if (empty($title)) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'El título de la publicación es obligatorio.'
            ]);
        }

        if (mb_strlen($title, 'UTF-8') > 200) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'El título no puede exceder los 200 caracteres.'
            ]);
        }

        if (empty($content)) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'El contenido de la publicación es obligatorio.'
            ]);
        }

        if (!empty($externalLink) && !filter_var($externalLink, FILTER_VALIDATE_URL)) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'El enlace externo proporcionado no tiene un formato de URL válido.'
            ]);
        }

        // Si se envió un archivo directamente en multipart/form-data
        if (isset($_FILES['file']) && is_array($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
            try {
                $uploadResult = $this->handleFileUpload($_FILES['file']);
                $fileUrl = $uploadResult['file_url'];
                $fileType = $uploadResult['file_type'];
            } catch (\Exception $e) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }

        // Validar file_type contra el ENUM de la base de datos si existe
        $validFileTypes = ['pdf', 'image', 'document', 'other'];
        if (!empty($fileType) && !in_array($fileType, $validFileTypes, true)) {
            $fileType = 'other';
        }

        try {
            $newPostId = $this->forumModel->createPost([
                'user_id'       => $currentUserId,
                'title'         => $title,
                'content'       => $content,
                'file_url'      => !empty($fileUrl) ? $fileUrl : null,
                'file_type'     => !empty($fileType) ? $fileType : null,
                'external_link' => !empty($externalLink) ? $externalLink : null,
            ]);

            $createdPost = $this->forumModel->getPostById($newPostId);

            $this->jsonResponse(201, [
                'success' => true,
                'message' => '¡Publicación creada exitosamente!',
                'data'    => $createdPost
            ]);
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al guardar la publicación en el servidor: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * PUT /api/posts/{id}
     * Edita una publicación existente.
     * Solo permitido para el autor de la publicación o moderadores (Admin/Coordinador).
     */
    public function update(int $id): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $post = $this->forumModel->getPostById($id);
        if (!$post) {
            $this->jsonResponse(404, [
                'success' => false,
                'message' => "La publicación con ID {$id} no existe."
            ]);
        }

        // Verificación de autoría o rol moderador
        $isAuthor = ((int)$post['user_id'] === $currentUserId);
        if (!$isAuthor && !$this->isModerator()) {
            $this->jsonResponse(403, [
                'success' => false,
                'message' => 'No tienes permisos para editar esta publicación.'
            ]);
        }

        $input = $this->parseInput();
        $dataToUpdate = [];

        if (isset($input['title'])) {
            $title = trim((string)$input['title']);
            if (empty($title)) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => 'El título no puede estar vacío.'
                ]);
            }
            if (mb_strlen($title, 'UTF-8') > 200) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => 'El título no puede superar los 200 caracteres.'
                ]);
            }
            $dataToUpdate['title'] = $title;
        }

        if (isset($input['content'])) {
            $content = trim((string)$input['content']);
            if (empty($content)) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => 'El contenido no puede estar vacío.'
                ]);
            }
            $dataToUpdate['content'] = $content;
        }

        if (array_key_exists('external_link', $input)) {
            $extLink = trim((string)$input['external_link']);
            if (!empty($extLink) && !filter_var($extLink, FILTER_VALIDATE_URL)) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => 'El enlace externo proporcionado no es válido.'
                ]);
            }
            $dataToUpdate['external_link'] = $extLink;
        }

        if (array_key_exists('file_url', $input)) {
            $dataToUpdate['file_url'] = trim((string)$input['file_url']);
        }

        if (array_key_exists('file_type', $input)) {
            $fType = trim((string)$input['file_type']);
            $validFileTypes = ['pdf', 'image', 'document', 'other'];
            $dataToUpdate['file_type'] = in_array($fType, $validFileTypes, true) ? $fType : 'other';
        }

        if (empty($dataToUpdate)) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'No se enviaron campos válidos para actualizar.'
            ]);
        }

        try {
            $this->forumModel->updatePost($id, $dataToUpdate);
            $updatedPost = $this->forumModel->getPostById($id);

            $this->jsonResponse(200, [
                'success' => true,
                'message' => 'Publicación actualizada correctamente.',
                'data'    => $updatedPost
            ]);
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al actualizar la publicación: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * DELETE /api/posts/{id}
     * Elimina una publicación (y sus comentarios en cascada).
     * Solo permitido para el autor de la publicación o moderadores (Admin/Coordinador).
     */
    public function destroy(int $id): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $post = $this->forumModel->getPostById($id);
        if (!$post) {
            $this->jsonResponse(404, [
                'success' => false,
                'message' => "La publicación con ID {$id} no existe."
            ]);
        }

        $isAuthor = ((int)$post['user_id'] === $currentUserId);
        if (!$isAuthor && !$this->isModerator()) {
            $this->jsonResponse(403, [
                'success' => false,
                'message' => 'No tienes permisos para eliminar esta publicación.'
            ]);
        }

        try {
            // Si tiene archivo local adjunto, se elimina del servidor
            if (!empty($post['file_url']) && str_starts_with($post['file_url'], 'public/uploads/forum/')) {
                $filePath = realpath(__DIR__ . '/../../' . $post['file_url']);
                if ($filePath && file_exists($filePath)) {
                    @unlink($filePath);
                }
            }

            $deleted = $this->forumModel->deletePost($id);

            if ($deleted) {
                $this->jsonResponse(200, [
                    'success' => true,
                    'message' => 'Publicación y comentarios asociados eliminados correctamente.'
                ]);
            } else {
                $this->jsonResponse(500, [
                    'success' => false,
                    'message' => 'No fue posible eliminar la publicación de la base de datos.'
                ]);
            }
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al eliminar la publicación: ' . $e->getMessage()
            ]);
        }
    }

    // =========================================================================
    // ENDPOINTS DE COMENTARIOS (comments)
    // =========================================================================

    /**
     * GET /api/posts/{id}/comments
     * Obtiene todos los comentarios de una publicación.
     */
    public function getComments(int $postId): void {
        try {
            $post = $this->forumModel->getPostById($postId);
            if (!$post) {
                $this->jsonResponse(404, [
                    'success' => false,
                    'message' => "La publicación con ID {$postId} no existe."
                ]);
            }

            $comments = $this->forumModel->getCommentsByPostId($postId);

            $this->jsonResponse(200, [
                'success' => true,
                'data'    => $comments
            ]);
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al consultar los comentarios: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * POST /api/posts/{id}/comments
     * Agrega un nuevo comentario a una publicación (requiere autenticación).
     */
    public function storeComment(int $postId): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $post = $this->forumModel->getPostById($postId);
        if (!$post) {
            $this->jsonResponse(404, [
                'success' => false,
                'message' => "La publicación con ID {$postId} no existe."
            ]);
        }

        $input = $this->parseInput();
        $commentText = trim((string)($input['comment_text'] ?? $input['content'] ?? ''));

        if (empty($commentText)) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'El texto del comentario es obligatorio.'
            ]);
        }

        if (mb_strlen($commentText, 'UTF-8') > 3000) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'El comentario no puede exceder los 3000 caracteres.'
            ]);
        }

        try {
            $newCommentId = $this->forumModel->createComment($postId, $currentUserId, $commentText);
            $newComment = $this->forumModel->getCommentById($newCommentId);

            $this->jsonResponse(201, [
                'success' => true,
                'message' => 'Comentario publicado con éxito.',
                'data'    => $newComment
            ]);
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al registrar el comentario: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * DELETE /api/comments/{id}
     * Elimina un comentario (solo autor o moderadores: Admin/Coordinador).
     */
    public function destroyComment(int $commentId): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $comment = $this->forumModel->getCommentById($commentId);
        if (!$comment) {
            $this->jsonResponse(404, [
                'success' => false,
                'message' => "El comentario con ID {$commentId} no existe."
            ]);
        }

        $isAuthor = ((int)$comment['user_id'] === $currentUserId);
        if (!$isAuthor && !$this->isModerator()) {
            $this->jsonResponse(403, [
                'success' => false,
                'message' => 'No tienes permisos para eliminar este comentario.'
            ]);
        }

        try {
            $deleted = $this->forumModel->deleteComment($commentId);
            if ($deleted) {
                $this->jsonResponse(200, [
                    'success' => true,
                    'message' => 'Comentario eliminado exitosamente.'
                ]);
            } else {
                $this->jsonResponse(500, [
                    'success' => false,
                    'message' => 'No se pudo eliminar el comentario de la base de datos.'
                ]);
            }
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al eliminar el comentario: ' . $e->getMessage()
            ]);
        }
    }

    // =========================================================================
    // ENDPOINTS COMPLEMENTARIOS (upload)
    // =========================================================================

    /**
     * POST /api/posts/upload
     * Subida asíncrona de archivos para previsualización o adjuntos desacoplados.
     */
    public function uploadFile(): void {
        AuthMiddleware::requireApiAuth();

        if (!isset($_FILES['file']) || !is_array($_FILES['file'])) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'No se recibió ningún archivo bajo el campo "file".'
            ]);
        }

        try {
            $result = $this->handleFileUpload($_FILES['file']);
            $this->jsonResponse(201, [
                'success' => true,
                'message' => 'Archivo subido correctamente.',
                'data'    => $result
            ]);
        } catch (\Exception $e) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
