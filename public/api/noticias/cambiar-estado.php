<?php
// public/api/noticias/cambiar.estado.php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/conn.php';

$news_id = intval($_GET['news_id'] ?? 0);

if ($news_id > 0) {
    try {
        $stmt = $pdo->prepare("SELECT status FROM news WHERE news_id = :news_id");
        $stmt->execute([':news_id' => $news_id]);
        $news = $stmt->fetch();

        if ($news) {
            $nuevoEstado = ($news['status'] === 'publicado') ? 'borrador' : 'publicado';

            $update = $pdo->prepare("UPDATE news SET status = :status WHERE news_id = :news_id");
            $update->execute([
                ':status'  => $nuevoEstado,
                ':news_id' => $news_id
            ]);
        }

        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=status_changed');
        exit;
    } catch (PDOException $e) {
        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=error');
        exit;
    }
} else {
    header('Location: ' . BASE_URL . 'index.php?page=noticias');
    exit;
}
?>