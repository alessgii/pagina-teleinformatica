<?php
// api/noticias/incrementar-vista.php
header('Content-Type: application/json');

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/conn.php';

$response = ['success' => false, 'views' => 0];

$newsId = isset($_POST['news_id']) ? intval($_POST['news_id']) : 0;

if ($newsId > 0 && isset($pdo) && $pdo instanceof PDO) {
    try {
        $stmt = $pdo->prepare("UPDATE news SET views = views + 1 WHERE news_id = :id");
        $stmt->bindValue(':id', $newsId, PDO::PARAM_INT);
        $stmt->execute();

        $stmtViews = $pdo->prepare("SELECT views FROM news WHERE news_id = :id");
        $stmtViews->bindValue(':id', $newsId, PDO::PARAM_INT);
        $stmtViews->execute();
        $views = $stmtViews->fetchColumn();

        $response['success'] = true;
        $response['views'] = intval($views);
    } catch (PDOException $e) {
        $response['error'] = 'Error al actualizar vistas';
    }
}

echo json_encode($response);