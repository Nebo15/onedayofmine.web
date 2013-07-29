
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `location_str` varchar(63) NULL DEFAULT NULL COLLATE utf8_general_ci AFTER image_ext;
ALTER TABLE `day` ADD `location_lat` float NULL DEFAULT NULL AFTER location_str;
ALTER TABLE `day` ADD `location_long` float NULL DEFAULT NULL AFTER location_lat;

SET FOREIGN_KEY_CHECKS = 1;
