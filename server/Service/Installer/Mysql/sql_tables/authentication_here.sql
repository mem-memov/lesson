CREATE TABLE IF NOT EXISTS `authentication_here` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `login` VARCHAR (255),
    `password` CHAR(32)
);