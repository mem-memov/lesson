CREATE TABLE IF NOT EXISTS `email` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `email` VARCHAR (255),
    `is_confirmed` BOOLEAN
);