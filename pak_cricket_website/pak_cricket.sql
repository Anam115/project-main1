CREATE DATABASE IF NOT EXISTS pak_cricket;
USE pak_cricket;

-- Table: news
CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    image_url VARCHAR(255),
    detail_link VARCHAR(255)
);

-- Table: users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    username VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'user') DEFAULT 'user'
);

-- Table: players
CREATE TABLE IF NOT EXISTS players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    role VARCHAR(100),
    image_url VARCHAR(255)
);

-- Table: comments
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    news_id INT,
    comment TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (news_id) REFERENCES news(id)
);

-- Table: questions
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT,
    asked_by VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
