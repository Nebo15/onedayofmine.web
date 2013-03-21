
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `device_notification` ADD `is_sended` int(1) unsigned NULL DEFAULT '0' AFTER device_token_id;
ALTER TABLE `device_notification` ADD `ctime` int(11) unsigned NULL DEFAULT NULL AFTER sound;
ALTER TABLE `device_notification` ADD `utime` int(11) unsigned NULL DEFAULT NULL AFTER ctime;
ALTER TABLE `device_notification` MODIFY `icon` int(2) unsigned NULL DEFAULT NULL;
ALTER TABLE `device_notification` MODIFY `sound` varchar(63) NULL DEFAULT NULL;

SET FOREIGN_KEY_CHECKS = 1;
