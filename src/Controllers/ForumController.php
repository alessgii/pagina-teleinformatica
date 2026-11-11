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

        if (!empty($_POST)) {
            return $_POST;
        }

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
        if (in_array($ext, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv'], true)) {
            return 'document';
        }
        return 'other';
    }

    /**
     * Optimiza iterativamente una imagen en el servidor si supera el límite de 3 MB
     * reduciendo calidad y redimensionando en pasadas sucesivas (requiere extensión GD).
     */
    private function optimizeImageIteratively(string $filePath, int $maxTargetBytes = 3145728): void {
        if (!file_exists($filePath) || filesize($filePath) <= $maxTargetBytes) {
            return;
        }
        if (!function_exists('imagecreatefromstring') || !function_exists('imagejpeg')) {
            return;
        }

        $rawBytes = @file_get_contents($filePath);
        if ($rawBytes === false) {
            return;
        }

        $srcImg = @imagecreatefromstring($rawBytes);
        if (!$srcImg) {
            return;
        }

        $width = imagesx($srcImg);
        $height = imagesy($srcImg);
        $qualities = [82, 68, 55, 42];
        $scales = [0.85, 0.75, 0.65, 0.55];

        foreach ($qualities as $idx => $quality) {
            $scale = $scales[$idx];
            $newW = max(320, (int) round($width * $scale));
            $newH = max(240, (int) round($height * $scale));

            $canvas = imagecreatetruecolor($newW, $newH);
            if (!$canvas) {
                break;
            }

            // Fondo blanco por si proviene de PNG con transparencia
            $white = imagecolorallocate($canvas, 255, 255, 255);
            imagefill($canvas, 0, 0, $white);
            imagecopyresampled($canvas, $srcImg, 0, 0, 0, 0, $newW, $newH, $width, $height);

            if (function_exists('imagewebp') && str_ends_with(strtolower($filePath), '.webp')) {
                @imagewebp($canvas, $filePath, $quality);
            } else {
                @imagejpeg($canvas, $filePath, $quality);
            }

            imagedestroy($canvas);
            clearstatcache(true, $filePath);

            if (filesize($filePath) <= $maxTargetBytes) {
                break;
            }
        }

        imagedestroy($srcImg);
    }

    /**
     * Procesa la subida física de un archivo adjunto al servidor de forma segura.
     *
     * @param array $file Arreglo de $_FILES['file']
     * @return array [ 'file_url' => string, 'file_type' => string, 'file_name' => string ]
     * @throws Exception Si el archivo no es válido o falla la subida
     */
    private function handleFileUpload(array $file): array {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            if (in_array($file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) {
                throw new Exception('El archivo supera el límite máximo permitido por el servidor (10 MB).');
            }
            throw new Exception('Error durante la subida del archivo adjunto (Código ' . $file['error'] . ').');
        }

        // Límite de tamaño: 10 MB para documentos, 3 MB objetivo para imágenes ya optimizadas
        $maxBytes = 10 * 1024 * 1024;
        if ($file['size'] > $maxBytes) {
            throw new Exception('El archivo adjunto supera el tamaño máximo permitido de 10 MB.');
        }

        $originalName = (string) ($file['name'] ?? '');
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // Extensiones estrictamente prohibidas (ejecutables y scripts)
        $forbiddenExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phps', 'cgi', 'pl', 'exe', 'bat', 'cmd', 'sh', 'js', 'jar', 'html', 'htm', 'svg'];
        if (in_array($ext, $forbiddenExtensions, true) || empty($ext)) {
            throw new Exception('Tipo de archivo no permitido por motivos de seguridad.');
        }

        // Extensiones permitidas para la comunidad universitaria
        $allowedExtensions = ['pdf', 'png', 'jpg', 'jpeg', 'webp', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'zip', 'rar', 'csv'];
        if (!in_array($ext, $allowedExtensions, true)) {
            throw new Exception('Formato de archivo no soportado. Extensiones admitidas: ' . implode(', ', $allowedExtensions));
        }

        // Validación real de tipo MIME mediante inspección binaria (finfo)
        if (function_exists('finfo_open') && !empty($file['tmp_name']) && file_exists($file['tmp_name'])) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $detectedMime = $finfo ? finfo_file($finfo, $file['tmp_name']) : '';
            if ($finfo) {
                finfo_close($finfo);
            }

            $forbiddenMimes = [
                'text/x-php',
                'application/x-httpd-php',
                'application/x-php',
                'text/html',
                'application/javascript',
                'application/x-executable',
                'application/x-msdos-program',
                'application/x-sh',
            ];
            if (!empty($detectedMime) && in_array($detectedMime, $forbiddenMimes, true)) {
                throw new Exception('El contenido binario del archivo fue rechazado por seguridad.');
            }
        }

        $baseUploadDir = realpath(__DIR__ . '/../../public') ?: (__DIR__ . '/../../public');
        $targetDir = $baseUploadDir . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'forum';

        if (!is_dir($targetDir)) {
            if (!@mkdir($targetDir, 0775, true) && !is_dir($targetDir)) {
                throw new Exception('No se pudo crear el directorio de subidas en el servidor.');
            }
        }

        $safeFileName = date('Ymd_His') . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
        $destination = $targetDir . DIRECTORY_SEPARATOR . $safeFileName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception('No fue posible almacenar el archivo en el servidor.');
        }

        $fileType = $this->mapExtensionToFileType($ext);

        // Si es imagen y supera los 3 MB, aplicar algoritmo iterativo de optimización en servidor
        if ($fileType === 'image' && filesize($destination) > 3 * 1024 * 1024) {
            $this->optimizeImageIteratively($destination, 3 * 1024 * 1024);
            if (filesize($destination) > 3 * 1024 * 1024) {
                @unlink($destination);
                throw new Exception('La imagen supera el límite de 3 MB incluso tras optimizarse. Sube una imagen más ligera.');
            }
        }

        $relativeUrl = 'public/uploads/forum/' . $safeFileName;

        return [
            'file_url'  => $relativeUrl,
            'file_type' => $fileType,
            'file_name' => $originalName
        ];
    }

    /**
     * Elimina del disco un archivo adjunto local previo si pertenece al directorio del foro.
     */
    private function removeLocalFile(?string $relativeUrl): void {
        if (!empty($relativeUrl) && str_starts_with($relativeUrl, 'public/uploads/forum/')) {
            $filePath = realpath(__DIR__ . '/../../' . $relativeUrl);
            if ($filePath && file_exists($filePath)) {
                @unlink($filePath);
            }
        }
    }

    // =========================================================================
    // ENDPOINTS DE PUBLICACIONES (posts)
    // =========================================================================

    /**
     * GET /api/posts
     * Listado público de publicaciones con paginación, búsqueda, filtro por categoría y recursos.
     */
    public function index(): void {
        try {
            $page = max(1, (int) ($_GET['page'] ?? 1));
            $limit = min(50, max(1, (int) ($_GET['limit'] ?? 10)));
            $offset = ($page - 1) * $limit;

            $search = isset($_GET['search']) ? trim((string) $_GET['search']) : null;
            if ($search === '') {
                $search = null;
            }

            $userId = isset($_GET['user_id']) ? (int) $_GET['user_id'] : null;
            if ($userId !== null && $userId <= 0) {
                $userId = null;
            }

            $category = isset($_GET['category']) ? strtolower(trim((string) $_GET['category'])) : null;
            if (!empty($category) && !in_array($category, Forum::VALID_CATEGORIES, true)) {
                $category = null;
            }

            $onlyWithResources = isset($_GET['has_resources']) && in_array((string) $_GET['has_resources'], ['1', 'true'], true);
            $viewerUserId = AuthMiddleware::getUserId();

            $posts = $this->forumModel->getPosts($limit, $offset, $search, $userId, $category, $onlyWithResources, $viewerUserId);
            $total = $this->forumModel->countPosts($search, $userId, $category, $onlyWithResources);
            $totalPages = $total > 0 ? (int) ceil($total / $limit) : 1;
            $categoryCounts = $this->forumModel->getCategoryCounts();

            $this->jsonResponse(200, [
                'success'         => true,
                'data'            => $posts,
                'category_counts' => $categoryCounts,
                'pagination'      => [
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
            $viewerUserId = AuthMiddleware::getUserId();
            $post = $this->forumModel->getPostById($id, $viewerUserId);

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
     */
    public function store(): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $input = $this->parseInput();

        $category = Forum::normalizeCategory((string) ($input['category'] ?? 'general'));
        $title = trim((string) ($input['title'] ?? ''));
        $content = trim((string) ($input['content'] ?? ''));
        $externalLink = trim((string) ($input['external_link'] ?? ''));
        $fileUrl = trim((string) ($input['file_url'] ?? ''));
        $fileType = trim((string) ($input['file_type'] ?? ''));

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

        $validFileTypes = ['pdf', 'image', 'document', 'other'];
        if (!empty($fileType) && !in_array($fileType, $validFileTypes, true)) {
            $fileType = 'other';
        }

        try {
            $newPostId = $this->forumModel->createPost([
                'user_id'       => $currentUserId,
                'category'      => $category,
                'title'         => $title,
                'content'       => $content,
                'file_url'      => !empty($fileUrl) ? $fileUrl : null,
                'file_type'     => !empty($fileType) ? $fileType : null,
                'external_link' => !empty($externalLink) ? $externalLink : null,
            ]);

            $createdPost = $this->forumModel->getPostById($newPostId, $currentUserId);

            $this->jsonResponse(201, [
                'success' => true,
                'message' => 'Publicación creada exitosamente.',
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
     * PUT / POST /api/posts/{id}
     * Edita una publicación existente (admite JSON o multipart/form-data para reemplazar archivo).
     */
    public function update(int $id): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $post = $this->forumModel->getPostById($id, $currentUserId);
        if (!$post) {
            $this->jsonResponse(404, [
                'success' => false,
                'message' => "La publicación con ID {$id} no existe."
            ]);
        }

        $isAuthor = ((int) $post['user_id'] === $currentUserId);
        if (!$isAuthor && !$this->isModerator()) {
            $this->jsonResponse(403, [
                'success' => false,
                'message' => 'No tienes permisos para editar esta publicación.'
            ]);
        }

        $input = $this->parseInput();
        $dataToUpdate = [];

        if (isset($input['category'])) {
            $dataToUpdate['category'] = Forum::normalizeCategory((string) $input['category']);
        }

        if (isset($input['title'])) {
            $title = trim((string) $input['title']);
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
            $content = trim((string) $input['content']);
            if (empty($content)) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => 'El contenido no puede estar vacío.'
                ]);
            }
            $dataToUpdate['content'] = $content;
        }

        if (array_key_exists('external_link', $input)) {
            $extLink = trim((string) $input['external_link']);
            if (!empty($extLink) && !filter_var($extLink, FILTER_VALIDATE_URL)) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => 'El enlace externo proporcionado no es válido.'
                ]);
            }
            $dataToUpdate['external_link'] = $extLink;
        }

        // Si el usuario solicitó quitar el archivo actual
        if (!empty($input['remove_file']) && in_array((string) $input['remove_file'], ['1', 'true'], true)) {
            $this->removeLocalFile($post['file_url'] ?? null);
            $dataToUpdate['file_url'] = null;
            $dataToUpdate['file_type'] = null;
        }

        // Si adjuntó un nuevo archivo al editar
        if (isset($_FILES['file']) && is_array($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
            try {
                $uploadResult = $this->handleFileUpload($_FILES['file']);
                $this->removeLocalFile($post['file_url'] ?? null);
                $dataToUpdate['file_url'] = $uploadResult['file_url'];
                $dataToUpdate['file_type'] = $uploadResult['file_type'];
            } catch (\Exception $e) {
                $this->jsonResponse(400, [
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            if (array_key_exists('file_url', $input)) {
                $dataToUpdate['file_url'] = trim((string) $input['file_url']);
            }
            if (array_key_exists('file_type', $input)) {
                $fType = trim((string) $input['file_type']);
                $validFileTypes = ['pdf', 'image', 'document', 'other'];
                $dataToUpdate['file_type'] = in_array($fType, $validFileTypes, true) ? $fType : 'other';
            }
        }

        if (empty($dataToUpdate)) {
            $this->jsonResponse(400, [
                'success' => false,
                'message' => 'No se enviaron campos válidos para actualizar.'
            ]);
        }

        try {
            $this->forumModel->updatePost($id, $dataToUpdate);
            $updatedPost = $this->forumModel->getPostById($id, $currentUserId);

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
     * POST /api/posts/{id}/like
     * Alterna el voto "Útil" del usuario autenticado sobre una publicación.
     */
    public function toggleLike(int $postId): void {
        AuthMiddleware::requireApiAuth();
        $currentUserId = AuthMiddleware::getUserId();

        $post = $this->forumModel->getPostById($postId);
        if (!$post) {
            $this->jsonResponse(404, [
                'success' => false,
                'message' => "La publicación con ID {$postId} no existe."
            ]);
        }

        try {
            $result = $this->forumModel->toggleLike($postId, $currentUserId);
            $this->jsonResponse(200, [
                'success' => true,
                'message' => $result['liked'] ? 'Marcado como útil.' : 'Marca retirada.',
                'data'    => $result
            ]);
        } catch (\Throwable $e) {
            $this->jsonResponse(500, [
                'success' => false,
                'message' => 'Error al procesar la reacción: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * DELETE /api/posts/{id}
     * Elimina una publicación (y sus comentarios y likes en cascada).
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

        $isAuthor = ((int) $post['user_id'] === $currentUserId);
        if (!$isAuthor && !$this->isModerator()) {
            $this->jsonResponse(403, [
                'success' => false,
                'message' => 'No tienes permisos para eliminar esta publicación.'
            ]);
        }

        try {
            $this->removeLocalFile($post['file_url'] ?? null);
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
        $commentText = trim((string) ($input['comment_text'] ?? $input['content'] ?? ''));

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

        $isAuthor = ((int) $comment['user_id'] === $currentUserId);
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
