<?php

class User {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("
            SELECT user_id, full_name, institutional_email, password_hash, role_id 
            FROM users 
            WHERE institutional_email = :email 
            LIMIT 1
        ");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function create(string $fullName, string $email, string $passwordHash, int $roleId = 4): int {
        $stmt = $this->db->prepare("
            INSERT INTO users (full_name, institutional_email, password_hash, role_id) 
            VALUES (:full_name, :email, :password_hash, :role_id)
        ");
        $stmt->execute([
            'full_name'     => $fullName,
            'email'         => $email,
            'password_hash' => $passwordHash,
            'role_id'       => $roleId,
        ]);

        return (int) $this->db->lastInsertId();
    }
}