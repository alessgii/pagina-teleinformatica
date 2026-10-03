<?php

declare(strict_types=1);

class FeedbackController {
    private Feedback $feedbackModel;

    public function __construct(Feedback $feedbackModel) {
        $this->feedbackModel = $feedbackModel;
    }

    /**
     * Procesa y almacena una nueva respuesta de retroalimentación UX.
     */
    public function store(): void {
        header('Content-Type: application/json; charset=utf-8');

        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true);

        if (!is_array($data)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Cuerpo de la petición inválido. Se espera formato JSON.'
            ], JSON_UNESCAPED_UNICODE);
            return;
        }

        // 1. Validar Rol
        $role = trim((string)($data['role'] ?? $data['role_reported'] ?? ''));
        if (empty($role)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Por favor indica tu rol en la comunidad universitaria.'
            ], JSON_UNESCAPED_UNICODE);
            return;
        }

        // 2. Validar Calificaciones UX (1 a 5)
        $ratings = $data['ratings'] ?? [];
        $nav = $ratings['navigation'] ?? $data['score_navigation'] ?? null;
        $visual = $ratings['visual'] ?? $data['score_visual'] ?? null;
        $speed = $ratings['performance'] ?? $ratings['speed'] ?? $data['score_speed'] ?? null;
        $mobile = $ratings['mobile'] ?? $data['score_mobile'] ?? null;

        if ($nav === null || $visual === null || $speed === null || $mobile === null) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Es necesario calificar los 4 aspectos de experiencia de usuario (Navegación, Visual, Rendimiento y Móvil).'
            ], JSON_UNESCAPED_UNICODE);
            return;
        }

        $scores = ['navigation' => (int)$nav, 'visual' => (int)$visual, 'speed' => (int)$speed, 'mobile' => (int)$mobile];
        foreach ($scores as $aspect => $score) {
            if ($score < 1 || $score > 5) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "La calificación para '{$aspect}' debe ser un valor entre 1 y 5."
                ], JSON_UNESCAPED_UNICODE);
                return;
            }
        }

        // 3. Validar Prioridades (arreglo opcional)
        $priorities = $data['priorities'] ?? $data['priority_features'] ?? [];
        if (!is_array($priorities)) {
            $priorities = [];
        }

        // 4. Validar Comentarios (opcional, máx 500 caracteres)
        $comments = trim((string)($data['comments'] ?? ''));
        if (mb_strlen($comments, 'UTF-8') > 500) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'El comentario no puede superar los 500 caracteres.'
            ], JSON_UNESCAPED_UNICODE);
            return;
        }

        // 5. Preparar registro 100% Anónimo
        $record = [
            'role_reported' => $role,
            'ratings'       => [
                'navigation'  => $scores['navigation'],
                'visual'      => $scores['visual'],
                'performance' => $scores['speed'],
                'mobile'      => $scores['mobile'],
            ],
            'priorities'    => $priorities,
            'comments'      => !empty($comments) ? $comments : null,
        ];

        try {
            $created = $this->feedbackModel->create($record);

            if ($created) {
                http_response_code(201);
                echo json_encode([
                    'success' => true,
                    'message' => '¡Aporte registrado con éxito! Gracias por ayudarnos a mejorar la plataforma.',
                    'data'    => [
                        'role'       => $role,
                        'ratings'    => $scores,
                        'priorities' => $priorities,
                    ]
                ], JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => 'No se pudo guardar la retroalimentación en la base de datos.'
                ], JSON_UNESCAPED_UNICODE);
            }
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Ocurrió un error inesperado al procesar tu solicitud.'
            ], JSON_UNESCAPED_UNICODE);
        }
    }
}
