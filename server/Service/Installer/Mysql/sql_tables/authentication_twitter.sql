CREATE TABLE IF NOT EXISTS `authentication_twitter` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `twitter_id` INT NOT NULL
);