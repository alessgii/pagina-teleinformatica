<?php

declare(strict_types=1);

/**
 * Devuelve el horario de clases de un semestre y grupo en formato JSON.
 *
 * Endpoint: GET /api/horarios?semestre=3&grupo=A
 */
class ScheduleController
{
    private const MIN_SEMESTER = 1;
    private const MAX_SEMESTER = 8;
    private const VALID_GROUPS = ['A', 'B'];
    private const DEFAULT_GROUP = 'A';

    /** @var PDO */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSchedule(): void
    {
        $semester = $this->readSemester();
        if ($semester === null) {
            $this->respond(400, [
                'success' => false,
                'message' => 'El semestre debe ser un número del ' . self::MIN_SEMESTER . ' al ' . self::MAX_SEMESTER . '.',
            ]);
            return;
        }

        $group = $this->readGroup();
        if ($group === null) {
            $this->respond(400, [
                'success' => false,
                'message' => 'El grupo debe ser uno de: ' . implode(', ', self::VALID_GROUPS) . '.',
            ]);
            return;
        }

        try {
            $rows = $this->fetchRows($semester, $group);
        } catch (PDOException $ex) {
            error_log('ScheduleController::getSchedule - ' . $ex->getMessage());
            $this->respond(500, [
                'success' => false,
                'message' => 'No se pudo consultar el horario. Inténtalo más tarde.',
            ]);
            return;
        }

        $this->respond(200, [
            'success' => true,
            'data' => [
                'semester' => $semester,
                'group' => $group,
                'classes' => array_map([$this, 'normalizeRow'], $rows),
            ],
        ]);
    }

    /* ---------------------------------------------------------------
     * Parámetros
     * ------------------------------------------------------------- */

    private function readSemester(): ?int
    {
        $raw = $_GET['semester'] ?? null;
        if (!is_scalar($raw) || !ctype_digit((string) $raw)) {
            return null;
        }

        $value = (int) $raw;
        return ($value >= self::MIN_SEMESTER && $value <= self::MAX_SEMESTER) ? $value : null;
    }

    private function readGroup(): ?string
    {
        $raw = $_GET['group'] ?? self::DEFAULT_GROUP;
        if (!is_scalar($raw)) {
            return null;
        }

        $value = strtoupper(trim((string) $raw));
        return in_array($value, self::VALID_GROUPS, true) ? $value : null;
    }

    /* ---------------------------------------------------------------
     * Datos
     * ------------------------------------------------------------- */

    private function fetchRows(int $semester, string $group): array
    {
        // Solo lunes a viernes (1 a 5); sábado y domingo no se muestran.
        $sql = "SELECT
                    h.day_of_week AS dia,
                    m.subject_name AS materia,
                    prof.full_name AS maestro,
                    s.room_number AS salon,
                    h.start_time AS hora_inicio,
                    h.end_time AS hora_fin
                FROM schedules h
                INNER JOIN student_groups g ON h.group_id = g.group_id
                INNER JOIN semesters sem ON g.semester_id = sem.semester_id
                INNER JOIN subjects m ON h.subject_id = m.subject_id
                INNER JOIN teachers prof ON h.teacher_id = prof.teacher_id
                INNER JOIN classrooms s ON h.classroom_id = s.classroom_id
                WHERE sem.semester_number = :semestre
                  AND g.letter = :grupo
                  AND h.day_of_week BETWEEN 1 AND 5
                ORDER BY h.day_of_week, h.start_time";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':semestre', $semester, PDO::PARAM_INT);
        $stmt->bindValue(':grupo', $group, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Convierte una fila SQL en el formato que consume horarios.js.
     * Los horarios se expresan en minutos desde la medianoche.
     */
    private function normalizeRow(array $row): array
    {
        $start = $this->toMinutes((string) $row['hora_inicio']);
        $end = $this->toMinutes((string) $row['hora_fin']);

        return [
            'day' => (int) $row['dia'],
            'subject' => (string) $row['materia'],
            'teacher' => (string) $row['maestro'],
            'room' => (string) $row['salon'],
            'start' => $start,
            'end' => $end,
            // Las clases terminan en :59 (4:59 PM equivale a "hasta las 5:00 PM").
            'end_effective' => ($end % 60 === 59) ? $end + 1 : $end,
        ];
    }

    /** "17:00:00" -> 1020 */
    private function toMinutes(string $time): int
    {
        $parts = explode(':', $time);
        return ((int) $parts[0]) * 60 + (int) ($parts[1] ?? 0);
    }

    private function respond(int $status, array $payload): void
    {
        http_response_code($status);
        echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    }
}