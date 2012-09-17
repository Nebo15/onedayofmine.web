
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `views_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER is_deleted;

ALTER TABLE `device_notification` ADD `is_sended` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER sound;
ALTER TABLE `device_notification` ADD  `ctime` INT( 11 ) UNSIGNED NOT NULL;
ALTER TABLE `device_notification` MODIFY `icon` int(2) unsigned NULL DEFAULT NULL COMMENT '';
ALTER TABLE `device_notification` MODIFY `sound` varchar(63) NULL DEFAULT NULL COMMENT '' COLLATE armscii8_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
