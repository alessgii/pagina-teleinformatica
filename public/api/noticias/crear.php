<?php
// public/api/noticias/crear.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $content     = trim($_POST['content'] ?? '');
    $category_id = intval($_POST['category_id'] ?? 0);
    
    // Capturar el valor enviado desde el botón ('borrador' o 'publicado')
    $status = trim($_POST['status'] ?? 'publicado');
    if (!in_array($status, ['publicado', 'borrador'])) {
        $status = 'publicado';
    }

    $user_id = $_SESSION['user_id'] ?? 1;

    if (empty($title) || empty($content) || $category_id <= 0) {
        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=error&msg=campos_incompletos');
        exit;
    }

    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $extPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $extPermitidas)) {
            $nombreImagen = uniqid('news_') . '.' . $ext;
            $directorioDestino = __DIR__ . '/../../img/uploads/noticias/';

            if (!is_dir($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $directorioDestino . $nombreImagen)) {
                $image_url = $nombreImagen;
            }
        }
    }

    try {
        // Se guarda con la columna :status recibida
        $stmt = $pdo->prepare("
            INSERT INTO news (title, content, category_id, user_id, image_url, status, publication_date, views) 
            VALUES (:title, :content, :category_id, :user_id, :image_url, :status, NOW(), 0)
        ");

        $stmt->execute([
            ':title'       => $title,
            ':content'     => $content,
            ':category_id' => $category_id,
            ':user_id'     => $user_id,
            ':image_url'   => $image_url,
            ':status'      => $status
        ]);

        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=success');
        exit;

    } catch (PDOException $e) {
        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=error&msg=' . urlencode($e->getMessage()));
        exit;
    }
}