DROP DATABASE IF EXISTS `esgi-webapi-2i2-2022`;

CREATE DATABASE `esgi-webapi-2i2-2022` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE `users` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL,
    username VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone CHAR(10) NOT NULL,
    website VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

// posts
// albums
// comments
// todos
// photos
