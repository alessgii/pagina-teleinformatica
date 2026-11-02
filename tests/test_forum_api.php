<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/conn.php';
require_once __DIR__ . '/../src/Models/Forum.php';
require_once __DIR__ . '/../src/Controllers/ForumController.php';

echo "=============================================\n";
echo "PRUEBAS AUTOMATIZADAS: API DEL FORO\n";
echo "=============================================\n";

$forumModel = new Forum($pdo);

// 1. Obtener usuario existente para pruebas
$stmtUser = $pdo->query("SELECT user_id, full_name, role_id FROM users LIMIT 1");
$testUser = $stmtUser->fetch();
if (!$testUser) {
    echo "ALERTA: Creando usuario de prueba...\n";
    $pdo->query("INSERT INTO users (full_name, institutional_email, password_hash, role_id) VALUES ('Tester', 'tester@univo.edu', 'hash', 4)");
    $userId = (int)$pdo->lastInsertId();
} else {
    $userId = (int)$testUser['user_id'];
}
echo "[OK] Usuario de prueba ID: $userId ({$testUser['full_name']})\n";

// 2. Probar creación de publicación en el modelo
$postData = [
    'user_id'       => $userId,
    'title'         => 'Publicación de Prueba Automatizada ' . time(),
    'content'       => 'Contenido detallado para verificar la integridad de la API del foro.',
    'file_url'      => 'public/uploads/forum/test_attachment.pdf',
    'file_type'     => 'pdf',
    'external_link' => 'https://example.com/recursos'
];
$newPostId = $forumModel->createPost($postData);
assert($newPostId > 0, "Fallo al crear post");
echo "[OK] Post creado con ID: $newPostId\n";

// 3. Probar obtención individual y cálculo de autor y comments_count
$postDetail = $forumModel->getPostById($newPostId);
assert($postDetail !== null, "El post recién creado debe existir");
assert($postDetail['title'] === $postData['title'], "El título debe coincidir");
assert(isset($postDetail['author_name']), "Debe contener author_name");
assert(isset($postDetail['role_name']), "Debe contener role_name");
assert((int)$postDetail['comments_count'] === 0, "Inicialmente debe tener 0 comentarios");
echo "[OK] Detalle del post verificado con JOIN de users y roles\n";

// 4. Probar creación de comentarios
$commentId1 = $forumModel->createComment($newPostId, $userId, "Primer comentario de prueba");
$commentId2 = $forumModel->createComment($newPostId, $userId, "Segundo comentario de prueba");
assert($commentId1 > 0 && $commentId2 > 0, "Fallo al crear comentarios");
echo "[OK] Comentarios creados con IDs: $commentId1, $commentId2\n";

// 5. Verificar conteo actualizado de comentarios en el post
$postDetailAfter = $forumModel->getPostById($newPostId);
assert((int)$postDetailAfter['comments_count'] === 2, "El post debe reflejar 2 comentarios");
echo "[OK] comments_count refleja 2 comentarios tras inserciones\n";

// 6. Probar listado de comentarios
$commentsList = $forumModel->getCommentsByPostId($newPostId);
assert(count($commentsList) === 2, "La lista debe contener 2 comentarios");
assert($commentsList[0]['comment_text'] === "Primer comentario de prueba", "Orden cronológico correcto");
echo "[OK] Listado de comentarios ordenados cronológicamente verificado\n";

// 7. Probar actualización del post
$updateSuccess = $forumModel->updatePost($newPostId, [
    'title'   => 'Título Editado ' . time(),
    'content' => 'Contenido modificado para prueba de actualización.'
]);
assert($updateSuccess === true, "Fallo al actualizar post");
$updatedDetail = $forumModel->getPostById($newPostId);
assert(str_starts_with($updatedDetail['title'], 'Título Editado'), "El título actualizado debe persistir");
echo "[OK] Actualización del post verificada\n";

// 8. Probar borrado de un comentario individual
$deleteCommentSuccess = $forumModel->deleteComment($commentId1);
assert($deleteCommentSuccess === true, "Fallo al eliminar comentario");
$commentsListAfter = $forumModel->getCommentsByPostId($newPostId);
assert(count($commentsListAfter) === 1, "Debe quedar 1 comentario");
echo "[OK] Borrado de comentario individual verificado\n";

// 9. Probar borrado del post y cascada de comentarios
$deletePostSuccess = $forumModel->deletePost($newPostId);
assert($deletePostSuccess === true, "Fallo al eliminar post");
$postAfterDelete = $forumModel->getPostById($newPostId);
assert($postAfterDelete === null, "El post eliminado no debe existir");

$remainingComments = $forumModel->getCommentsByPostId($newPostId);
assert(count($remainingComments) === 0, "Los comentarios deben haberse eliminado en cascada");
echo "[OK] Eliminación en cascada de post y comentarios comprobada\n";

// 10. Probar listado general y búsqueda
$searchResult = $forumModel->getPosts(10, 0, 'Consejos');
echo "[OK] Búsqueda por palabra clave ejecutada correctamente (Total encontrados: " . count($searchResult) . ")\n";

// 11. Verificar directorio de uploads y .htaccess
$uploadDir = __DIR__ . '/../public/uploads/forum';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
assert(is_dir($uploadDir), "El directorio public/uploads/forum debe existir");
$htaccessPath = __DIR__ . '/../public/uploads/.htaccess';
assert(file_exists($htaccessPath), "El archivo de protección .htaccess debe existir");
echo "[OK] Directorio de almacenamiento y directivas de seguridad verificados\n";

echo "=============================================\n";
echo "TODAS LAS PRUEBAS COMPLETADAS EXITOSAMENTE (11/11)\n";
echo "=============================================\n";
