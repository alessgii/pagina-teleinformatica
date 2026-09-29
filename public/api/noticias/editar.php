<?php
// api/noticias/editar.noticia.php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news_id     = intval($_POST['news_id'] ?? 0);
    $title       = trim($_POST['title'] ?? '');
    $content     = trim($_POST['content'] ?? '');
    $category_id = intval($_POST['category_id'] ?? 1);

    if ($news_id <= 0 || empty($title) || empty($content)) {
        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=error');
        exit;
    }

    try {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath   = $_FILES['image']['tmp_name'];
            $fileName      = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($fileExtension, $allowedExtensions)) {
                $stmtPrev = $pdo->prepare("SELECT image_url FROM news WHERE news_id = :news_id");
                $stmtPrev->execute([':news_id' => $news_id]);
                $prevNews = $stmtPrev->fetch();

                if (!empty($prevNews['image_url'])) {
                    $oldImgPath = __DIR__ . '/../../public/img/uploads/noticias/' . $prevNews['image_url'];
                    if (file_exists($oldImgPath)) {
                        unlink($oldImgPath);
                    }
                }

                $newImageName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadDir    = __DIR__ . '/../../public/img/uploads/noticias/';
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                move_uploaded_file($fileTmpPath, $uploadDir . $newImageName);

                $sql = "UPDATE news 
                        SET title = :title, content = :content, image_url = :image_url, category_id = :category_id 
                        WHERE news_id = :news_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':title'       => $title,
                    ':content'     => $content,
                    ':image_url'   => $newImageName,
                    ':category_id' => $category_id,
                    ':news_id'     => $news_id
                ]);
            }
        } else {
            $sql = "UPDATE news 
                    SET title = :title, content = :content, category_id = :category_id 
                    WHERE news_id = :news_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title'       => $title,
                ':content'     => $content,
                ':category_id' => $category_id,
                ':news_id'     => $news_id
            ]);
        }

        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=updated');
        exit;
    } catch (PDOException $e) {
        header('Location: ' . BASE_URL . 'index.php?page=noticias&status=error');
        exit;
    }
}
?>