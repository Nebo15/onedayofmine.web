
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `is_ended` tinyint(1) unsigned NOT NULL DEFAULT 0 AFTER description;

SET FOREIGN_KEY_CHECKS = 1;
