<?php

class AuthMiddleware {
    private static function startSession(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * PROTECCIÓN PARA LA API
     * Verifica autenticación y roles respondiendo en JSON con códigos HTTP correctos.
     *
     * @param array $allowedRoles Lista opcional de role_id permitidos
     */
    public static function requireApiAuth(array $allowedRoles = []): void {
        self::startSession();

        if (!isset($_SESSION['user_id'])) {
            http_response_code(401);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'success' => false,
                'message' => 'No autorizado. Debes iniciar sesión para acceder a este recurso.'
            ]);
            exit;
        }

        if (!empty($allowedRoles)) {
            $userRole = (int) ($_SESSION['role_id'] ?? 0);
            
            if (!in_array($userRole, $allowedRoles, true)) {
                http_response_code(403);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode([
                    'success' => false,
                    'message' => 'Acceso denegado. No cuentas con los permisos requeridos.'
                ]);
                exit;
            }
        }
    }

    /**
     * PROTECCIÓN PARA VISTAS/PÁGINAS WEB
     * Redirige al login si no está autenticado o muestra error si no tiene rol.
     *
     * @param array $allowedRoles Lista opcional de role_id autorizados
     */
    public static function requirePageAuth(array $allowedRoles = []): void {
        self::startSession();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /index.php?page=login');
            exit;
        }

        if (!empty($allowedRoles)) {
            $userRole = (int) ($_SESSION['role_id'] ?? 0);

            if (!in_array($userRole, $allowedRoles, true)) {
                http_response_code(403);
                echo '<h1>403 - Acceso Denegado</h1>';
                echo '<p>No tienes los permisos necesarios para ver esta sección.</p>';
                echo '<a href="/index.php?page=inicio">Volver al inicio</a>';
                exit;
            }
        }
    }

    public static function getUserId(): ?int {
        self::startSession();
        return isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
    }

    public static function getRoleId(): ?int {
        self::startSession();
        return isset($_SESSION['role_id']) ? (int) $_SESSION['role_id'] : null;
    }
}