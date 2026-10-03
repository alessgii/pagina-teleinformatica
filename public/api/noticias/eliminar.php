<?php
// api/noticias/eliminar.noticia.php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/conn.php';

$news_id = intval($_GET['news_id'] ?? $_POST['news_id'] ?? 0);

if ($news_id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT image_url FROM news WHERE news_id = :news_id");
        $stmt->execute([':news_id' => $news_id]);
        $news = $stmt->fetch();

        if ($news && !empty($news['image_url'])) {
            $imgPath = __DIR__ . '/../../public/img/uploads/noticias/' . $news['image_url'];
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }
        }

        $deleteStmt = $pdo->prepare("DELETE FROM news WHERE news_id = :news_id");
        $deleteStmt->execute([':news_id' => $news_id]);

        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=deleted');
        exit;
    } catch (PDOException $e) {
        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'index.php?page=noticias&status=invalid_id');
    exit;
}
?>