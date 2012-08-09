CREATE TABLE IF NOT EXISTS `part_widget` (
    `part_id` INT NOT NULL,
    `widget_type_id` INT NOT NULL,
    `widget_id` INT NOT NULL,
    `x` SMALLINT NOT NULL,
    `y` SMALLINT NOT NULL,
    `z` SMALLINT NOT NULL,
    `width` SMALLINT NOT NULL,
    `height` SMALLINT NOT NULL
);