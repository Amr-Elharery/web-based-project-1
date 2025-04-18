
-- copy and past this sql query in database --
CREATE DATABASE my_project;

USE my_project;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    user_name VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(15),
    whatsapp VARCHAR(15),
    address TEXT,
    password VARCHAR(255),
    user_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
