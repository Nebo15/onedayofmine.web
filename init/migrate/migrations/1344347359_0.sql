
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `moment` ADD `image_shoot_time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER image_ext;
ALTER TABLE `moment` ADD INDEX `image_shoot_time` (`image_shoot_time`);


SET FOREIGN_KEY_CHECKS = 1;
