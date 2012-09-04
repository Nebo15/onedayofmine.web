
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `location` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER description;
ALTER TABLE `day` DROP `occupation`;
ALTER TABLE `day` DROP `age`;

SET FOREIGN_KEY_CHECKS = 1;
