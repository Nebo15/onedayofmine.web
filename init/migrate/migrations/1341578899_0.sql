
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `first_name` varchar(50) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER id;
ALTER TABLE `user` ADD `last_name` varchar(50) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER first_name;
ALTER TABLE `user` DROP `name`;


SET FOREIGN_KEY_CHECKS = 1;
