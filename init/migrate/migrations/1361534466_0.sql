
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `is_gathering_enabled` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER image_ext;
ALTER TABLE `day` DROP `is_opened`;

SET FOREIGN_KEY_CHECKS = 1;
