-- Backup database schema

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS user_data_backup_test;
USE user_data_backup_test;

-- Create user_files table
CREATE TABLE user_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    filename VARCHAR(255) NOT NULL,
    file_type VARCHAR(50),
    size_kb INT,
    uploaded_at DATETIME,
    is_shared BOOLEAN DEFAULT FALSE,
    is_deleted BOOLEAN DEFAULT FALSE
);