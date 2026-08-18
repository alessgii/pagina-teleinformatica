-- =====================================================
-- Esquema de USUARIOS (solo login)
-- Base de datos: teleinformatica
-- Importa este archivo en phpMyAdmin (XAMPP) cuando se
-- unifiquen los esquemas con el equipo de Horarios.
-- =====================================================

CREATE DATABASE IF NOT EXISTS teleinformatica
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE teleinformatica;

CREATE TABLE IF NOT EXISTS users (
    id            INT UNSIGNED                  NOT NULL AUTO_INCREMENT,
    name          VARCHAR(100)                  NOT NULL,
    email         VARCHAR(190)                  NOT NULL,
    password_hash VARCHAR(255)                  NOT NULL,
    role          ENUM('student','teacher','admin') NOT NULL DEFAULT 'student',
    created_at    TIMESTAMP                     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP                     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_email (email)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Usuarios de prueba (todos con contraseña: 123456)
INSERT INTO users (name, email, password_hash) VALUES
('Usuario de Prueba', 'test@intel.com', '$2y$10$NuFcNhuADxd4YiNLDLv4huWGMgoYj96U94yVfsw2Eu73lB7eei2OO'),
('Juan Pérez',        'juan.perez@intel.com',   '$2y$10$YlvXSpKjGqW7f8a6uBVeEOuEyu0QHJrMYUyLK6YkAahWz.Rz/nqFK'),
('María Rodríguez',   'maria.rodriguez@intel.com', '$2y$10$HmG4xhRqkUI67W1YdziCi.Zy6eY92YMOCR95.xVQq9iQ.hIZ5emxW'),
('Carlos López',      'carlos.lopez@intel.com', '$2y$10$z2by5dRZJNynIHsuIxWaV.msx1G9UK9.ysQd9se8iAibYESK7Q2tu'),
('Ana García',        'ana.garcia@intel.com',   '$2y$10$.ZGefy2AdVFNosFVIXKbX.vFcVFtOJtxqQqgv28LZU0qlCNna/yjm');
