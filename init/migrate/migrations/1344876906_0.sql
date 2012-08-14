
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `moment` ADD `location_latitude` float NOT NULL DEFAULT '0' COMMENT '' AFTER description;
ALTER TABLE `moment` ADD `location_longitude` float NOT NULL DEFAULT '0' COMMENT '' AFTER location_latitude;


SET FOREIGN_KEY_CHECKS = 1;
