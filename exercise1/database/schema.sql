-- Thesis database schema

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS thesis;
USE thesis;

-- Create graduate_theses table
CREATE TABLE IF NOT EXISTS graduate_theses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    work_name VARCHAR(255) NOT NULL,
    work_text TEXT NOT NULL,
    work_link VARCHAR(255) NOT NULL,
    identification_number VARCHAR(50) NOT NULL
);

-- Add unique constraint to prevent duplicates
ALTER TABLE graduate_theses ADD UNIQUE INDEX work_link_idx (work_link);
