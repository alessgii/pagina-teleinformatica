<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

require_once __DIR__ . '/../../config/conn.php';
require_once __DIR__ . '/../../src/Models/User.php';
require_once __DIR__ . '/../../src/Controllers/AuthController.php';
require_once __DIR__ . '/../../src/Controllers/GalleryController.php';
require_once __DIR__ . '/../../src/Controllers/ScheduleController.php';
require_once __DIR__ . '/../../src/Models/Feedback.php';
require_once __DIR__ . '/../../src/Controllers/FeedbackController.php';
require_once __DIR__ . '/../../src/Models/Forum.php';
require_once __DIR__ . '/../../src/Controllers/ForumController.php';

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseApiPath = '/api';
$apiPos = strpos($requestUri, $baseApiPath);
$path = ($apiPos !== false) ? substr($requestUri, $apiPos) : $requestUri;
$path = rtrim($path, '/');

$userModel = new User($pdo);
$authController = new AuthController($userModel);
$galleryController = new GalleryController($pdo);
$scheduleController = new ScheduleController($pdo);
$feedbackModel = new Feedback($pdo);
$feedbackController = new FeedbackController($feedbackModel);
$forumModel = new Forum($pdo);
$forumController = new ForumController($forumModel);

// =========================================================================
// 1. RUTAS ESTÁTICAS
// =========================================================================
switch ($path) {
    // -----------------------------------------------------
    // AUTHENTICATION
    // -----------------------------------------------------
    case '/api/login':
        if ($method === 'POST') {
            $authController->login();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza POST.']);
        }
        return;

    case '/api/register':
        if ($method === 'POST') {
            $authController->register();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza POST.']);
        }
        return;

    case '/api/logout':
        if ($method === 'POST' || $method === 'GET') {
            $authController->logout();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        }
        return;

    // -----------------------------------------------------
    // GALLERY
    // -----------------------------------------------------
    case '/api/galeria':
        if ($method === 'GET') {
            $galleryController->getGaleria();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET.']);
        }
        return;

    // -----------------------------------------------------
    // SCHEDULES
    // -----------------------------------------------------
    case '/api/horarios':
        if ($method === 'GET') {
            $scheduleController->getSchedule();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET.']);
        }
        return;

    // -----------------------------------------------------
    // UX FEEDBACK
    // -----------------------------------------------------
    case '/api/feedback':
        if ($method === 'POST') {
            $feedbackController->store();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza POST.']);
        }
        return;

    // -----------------------------------------------------
    // FORUM: FEED & CREATION
    // -----------------------------------------------------
    case '/api/posts':
        if ($method === 'GET') {
            $forumController->index();
        } elseif ($method === 'POST') {
            $forumController->store();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET o POST.']);
        }
        return;

    case '/api/posts/upload':
        if ($method === 'POST') {
            $forumController->uploadFile();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza POST.']);
        }
        return;

    case '/api/me/posts':
        if ($method === 'GET') {
            $forumController->myPosts();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET.']);
        }
        return;
}

// =========================================================================
// 2. RUTAS DINÁMICAS (EXPRESIONES REGULARES)
// =========================================================================

// POST /api/posts/{id}/like
if (preg_match('#^/api/posts/(\d+)/like$#', $path, $matches)) {
    $postId = (int)$matches[1];
    if ($method === 'POST') {
        $forumController->toggleLike($postId);
    } else {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza POST.']);
    }
    return;
}

// GET /api/posts/{id}/comments o POST /api/posts/{id}/comments
if (preg_match('#^/api/posts/(\d+)/comments$#', $path, $matches)) {
    $postId = (int)$matches[1];
    if ($method === 'GET') {
        $forumController->getComments($postId);
    } elseif ($method === 'POST') {
        $forumController->storeComment($postId);
    } else {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET o POST.']);
    }
    return;
}

// GET, POST, PUT, PATCH, DELETE /api/posts/{id}
if (preg_match('#^/api/posts/(\d+)$#', $path, $matches)) {
    $postId = (int)$matches[1];
    if ($method === 'GET') {
        $forumController->show($postId);
    } elseif ($method === 'PUT' || $method === 'PATCH' || $method === 'POST') {
        $forumController->update($postId);
    } elseif ($method === 'DELETE') {
        $forumController->destroy($postId);
    } else {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET, POST, PUT o DELETE.']);
    }
    return;
}

// DELETE /api/comments/{id}
if (preg_match('#^/api/comments/(\d+)$#', $path, $matches)) {
    $commentId = (int)$matches[1];
    if ($method === 'DELETE') {
        $forumController->destroyComment($commentId);
    } else {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza DELETE.']);
    }
    return;
}

// GET /api/users/{id}/posts
if (preg_match('#^/api/users/(\d+)/posts$#', $path, $matches)) {
    $userId = (int)$matches[1];
    if ($method === 'GET') {
        $_GET['user_id'] = (string)$userId;
        $forumController->index();
    } else {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET.']);
    }
    return;
}

// =========================================================================
// 3. RESPUESTA 404 NO ENCONTRADO
// =========================================================================
http_response_code(404);
echo json_encode([
    'success' => false,
    'message' => "Endpoint '{$path}' no encontrado en la API."
], JSON_UNESCAPED_UNICODE);