
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `occupation` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER location;
ALTER TABLE `day` DROP `description`;


SET FOREIGN_KEY_CHECKS = 1;
