CREATE TABLE IF NOT EXISTS `visit` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `lesson_id` INT NOT NULL,
    `part_id` INT NOT NULL,
    `student_id` INT NOT NULL,
    `teacher_id` INT NOT NULL
);