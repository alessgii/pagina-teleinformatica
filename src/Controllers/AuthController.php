<?php

class AuthController {
    private User $userModel;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function login(): void {
        $data = json_decode(file_get_contents('php://input'), true);

        $email = trim($data['institutional_email'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($email) || empty($password)) {
            http_response_code(400);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Faltan campos obligatorios.']);
            return;
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            http_response_code(401);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Credenciales invalidas.']);
            return;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['full_name'] = $user['full_name'];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'success' => true,
            'message' => 'Sesión iniciada con éxito.',
            'user' => [
                'id' => $user['user_id'],
                'name' => $user['full_name'],
                'role' => $user['role_id']
            ]
        ]);
    }

    public function register(): void {
        $data = json_decode(file_get_contents('php://input'), true);

        $fullName = trim($data['full_name'] ?? '');
        $email = trim($data['institutional_email'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($fullName) || empty($email) || empty($password)) {
            http_response_code(400);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'El correo institucional no es válido.']);
            return;
        }

        if (strlen($password) < 6) {
            http_response_code(400);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres.']);
            return;
        }

        $existingUser = $this->userModel->findByEmail($email);
        if ($existingUser) {
            http_response_code(409);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'El correo ya se encuentra registrado.']);
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        // Rol por defecto: STUDENT (role_id = 4)
        $roleId = 4;

        try {
            $userId = $this->userModel->create($fullName, $email, $passwordHash, $roleId);

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            session_regenerate_id(true);

            $_SESSION['user_id'] = $userId;
            $_SESSION['role_id'] = $roleId;
            $_SESSION['full_name'] = $fullName;

            http_response_code(201);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'success' => true,
                'message' => 'Registro completado con éxito.',
                'user' => [
                    'id'   => $userId,
                    'name' => $fullName,
                    'role' => $roleId
                ]
            ]);
        } catch (\PDOException $e) {
            http_response_code(500);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario en el servidor.']);
        }
    }

    public function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => true, 'message' => 'Sesión cerrada.']);
    }
}