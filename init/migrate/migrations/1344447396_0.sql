
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` DROP `timezone`;
ALTER TABLE `moment` ADD `time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER image_ext;
ALTER TABLE `moment` ADD `timezone` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER time;
ALTER TABLE `moment` DROP INDEX image_shoot_time;
ALTER TABLE `moment` DROP `image_shoot_time`;

SET FOREIGN_KEY_CHECKS = 1;
