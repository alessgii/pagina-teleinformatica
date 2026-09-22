<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

require_once __DIR__ . '/../../config/conn.php';
require_once __DIR__ . '/../../src/Models/User.php';
require_once __DIR__ . '/../../src/Controllers/AuthController.php';
require_once __DIR__ . '/../../src/Controllers/GalleryController.php';

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$baseApiPath = '/api';
$apiPos = strpos($requestUri, $baseApiPath);
$path = ($apiPos !== false) ? substr($requestUri, $apiPos) : $requestUri;
$path = rtrim($path, '/');

$userModel = new User($pdo);
$authController = new AuthController($userModel);
$galleryController = new GalleryController($pdo);

switch ($path) {
    // =====================================================
    // 1. AUTHENTICATION
    // =====================================================
    case '/api/login':
        if ($method === 'POST') {
            $authController->login();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza POST.']);
        }
        break;

    case '/api/register':
        if ($method === 'POST') {
            $authController->register();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza POST.']);
        }
        break;

    case '/api/logout':
        if ($method === 'POST' || $method === 'GET') {
            $authController->logout();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        }
        break;

    // =====================================================
    // 2. GALLERY
    // =====================================================
    case '/api/galeria':
        if ($method === 'GET') {
            $galleryController->getGaleria();
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido. Utiliza GET.']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => "Endpoint '{$path}' no encontrado en la API."
        ]);
        break;
}