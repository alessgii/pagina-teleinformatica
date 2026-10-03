<?php

class Feedback {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Inserta un nuevo registro de retroalimentación UX (100% anónimo).
     */
    public function create(array $data): bool {
        $sql = "INSERT INTO feedback 
                (role_reported, score_navigation, score_visual, score_speed, score_mobile, priority_features, comments) 
                VALUES 
                (:role_reported, :nav, :visual, :speed, :mobile, :priorities, :comments)";

        $stmt = $this->db->prepare($sql);

        $nav = (int)($data['score_navigation'] ?? $data['ratings']['navigation'] ?? $data['ratings']['nav'] ?? 3);
        $visual = (int)($data['score_visual'] ?? $data['ratings']['visual'] ?? 3);
        $speed = (int)($data['score_speed'] ?? $data['ratings']['performance'] ?? $data['ratings']['speed'] ?? 3);
        $mobile = (int)($data['score_mobile'] ?? $data['ratings']['mobile'] ?? 3);

        // Limitar rango de 1 a 5
        $nav = max(1, min(5, $nav));
        $visual = max(1, min(5, $visual));
        $speed = max(1, min(5, $speed));
        $mobile = max(1, min(5, $mobile));

        // Rol reportado (máx 30 caracteres)
        $rawRole = (string)($data['role_reported'] ?? $data['role'] ?? 'Estudiante');
        $role = mb_substr(trim($rawRole), 0, 30, 'UTF-8');

        // Prioridades como JSON
        $priorities = $data['priority_features'] ?? $data['priorities'] ?? null;
        $prioritiesJson = (!empty($priorities) && is_array($priorities)) 
            ? json_encode(array_values($priorities), JSON_UNESCAPED_UNICODE) 
            : null;

        // Comentarios
        $comments = !empty($data['comments']) ? trim((string)$data['comments']) : null;
        if ($comments !== null && mb_strlen($comments, 'UTF-8') > 1000) {
            $comments = mb_substr($comments, 0, 1000, 'UTF-8');
        }

        return $stmt->execute([
            ':role_reported' => $role,
            ':nav'           => $nav,
            ':visual'        => $visual,
            ':speed'         => $speed,
            ':mobile'        => $mobile,
            ':priorities'    => $prioritiesJson,
            ':comments'      => $comments,
        ]);
    }

    /**
     * Obtiene los últimos registros de feedback registrados.
     */
    public function getAll(int $limit = 50): array {
        $stmt = $this->db->prepare("SELECT * FROM feedback ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene métricas promedio generales de usabilidad.
     */
    public function getSummary(): array {
        $sql = "SELECT 
                    COUNT(*) as total_responses,
                    AVG(score_navigation) as avg_navigation,
                    AVG(score_visual) as avg_visual,
                    AVG(score_speed) as avg_speed,
                    AVG(score_mobile) as avg_mobile
                FROM feedback";
        $stmt = $this->db->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }
}