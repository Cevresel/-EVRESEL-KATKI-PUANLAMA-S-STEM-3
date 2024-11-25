CREATE DATABASE env_credit_system;

USE env_credit_system;

-- Kullanıcılar tablosu
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),
    school VARCHAR(100),
    district VARCHAR(100),
    city VARCHAR(100),
    total_points INT DEFAULT 0
);

-- Atık teslimatları tablosu
CREATE TABLE waste_submission (
    submission_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    waste_type VARCHAR(50),
    waste_weight INT,
    points_earned INT,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
