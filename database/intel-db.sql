CREATE DATABASE IF NOT EXISTS intel
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;
USE intel;

-- =====================================================
-- 1. AUTHENTICATION & ROLES
-- =====================================================
CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB;

INSERT INTO roles (role_id, role_name) VALUES
(1, 'ADMIN'),
(2, 'COORDINATOR'),
(3, 'TEACHER'),
(4, 'STUDENT');

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    institutional_email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_users_role FOREIGN KEY (role_id) 
        REFERENCES roles(role_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

-- =====================================================
-- 2. ACADEMIC STRUCTURE & CURRICULUM
-- =====================================================
CREATE TABLE careers (
    career_id INT AUTO_INCREMENT PRIMARY KEY,
    career_name VARCHAR(80) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE semesters (
    semester_id INT AUTO_INCREMENT PRIMARY KEY,
    semester_number TINYINT NOT NULL,
    career_id INT NOT NULL,
    UNIQUE (semester_number, career_id),
    CONSTRAINT fk_semesters_career FOREIGN KEY (career_id) 
        REFERENCES careers(career_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE subjects (
    subject_id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL,
    subject_code VARCHAR(20) NOT NULL,
    credits TINYINT UNSIGNED NOT NULL DEFAULT 0,
    semester_id INT NOT NULL,
    CONSTRAINT fk_subjects_semester FOREIGN KEY (semester_id) 
        REFERENCES semesters(semester_id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;

CREATE TABLE subject_prerequisites (
    subject_id INT NOT NULL,
    prerequisite_id INT NOT NULL,
    PRIMARY KEY (subject_id, prerequisite_id),
    CONSTRAINT fk_prereq_subject FOREIGN KEY (subject_id) 
        REFERENCES subjects(subject_id) ON DELETE CASCADE,
    CONSTRAINT fk_prereq_requirement FOREIGN KEY (prerequisite_id) 
        REFERENCES subjects(subject_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- =====================================================
-- 3. SCHEDULES & ALLOCATIONS
-- =====================================================
CREATE TABLE student_groups (
    group_id INT AUTO_INCREMENT PRIMARY KEY,
    letter CHAR(1) NOT NULL,
    semester_id INT NOT NULL,
    UNIQUE (letter, semester_id),
    CONSTRAINT fk_groups_semester FOREIGN KEY (semester_id) 
        REFERENCES semesters(semester_id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE teachers (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE classrooms (
    classroom_id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(20) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE schedules (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    subject_id INT NOT NULL,
    teacher_id INT NOT NULL,
    classroom_id INT NOT NULL,
    day_of_week TINYINT NOT NULL COMMENT '1: Monday, ..., 7: Sunday',
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    CONSTRAINT fk_schedules_group FOREIGN KEY (group_id) REFERENCES student_groups(group_id) ON DELETE CASCADE,
    CONSTRAINT fk_schedules_subject FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE,
    CONSTRAINT fk_schedules_teacher FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id) ON DELETE RESTRICT,
    CONSTRAINT fk_schedules_classroom FOREIGN KEY (classroom_id) REFERENCES classrooms(classroom_id) ON DELETE RESTRICT
) ENGINE = InnoDB;

-- =====================================================
-- 4. FORUM & COMMUNITY
-- =====================================================
CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    file_url VARCHAR(255) NULL,
    file_type ENUM('pdf', 'image', 'document', 'other') NULL,
    external_link VARCHAR(255) NULL,
    publication_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_posts_user FOREIGN KEY (user_id) 
        REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    comment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_comments_post FOREIGN KEY (post_id) 
        REFERENCES posts(post_id) ON DELETE CASCADE,
    CONSTRAINT fk_comments_user FOREIGN KEY (user_id) 
        REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- =====================================================
-- 5. CAMPUS NEWS & ANNOUNCEMENTS
-- =====================================================
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE = InnoDB;

CREATE TABLE news (
    news_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255) DEFAULT 'public/img/news/default.jpg',
    publication_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    category_id INT NULL,
    user_id INT NULL,
    CONSTRAINT fk_news_category FOREIGN KEY (category_id) 
        REFERENCES categories(category_id) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_news_author FOREIGN KEY (user_id) 
        REFERENCES users(user_id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB;