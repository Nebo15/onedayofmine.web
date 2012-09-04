SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `occupation` varchar(255) NOT NULL DEFAULT '' COLLATE utf8_general_ci AFTER description;
ALTER TABLE `day` ADD `age` int(3) unsigned NOT NULL DEFAULT 0 AFTER occupation;
ALTER TABLE `day` ADD `type` int(2) unsigned NOT NULL DEFAULT 0 AFTER age;

SET FOREIGN_KEY_CHECKS = 1;
