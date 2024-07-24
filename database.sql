CREATE DATABASE IF NOT EXISTS user_management;
USE user_management;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- You can use either "SHOW TABLES" or "SHOW COLUMNS FROM users"
SHOW TABLES;
SHOW COLUMNS FROM users;
SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'user_management' AND TABLE_NAME = 'users' AND COLUMN_NAME = 'email'
