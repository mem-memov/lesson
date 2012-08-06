CREATE TABLE IF NOT EXISTS `user` (
    `id` INT NOT NULL PRIMARY KEY,
    `login` VARCHAR (255),
    `password` CHAR(32),
    `first_name` VARCHAR (255),
    `last_name` VARCHAR (255)
);