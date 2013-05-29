
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `date` date NOT NULL AFTER views_count;
ALTER TABLE `day` ADD INDEX `date` (`date`);
UPDATE  `one_day`.`day` SET  `date` = (SELECT DATE(FROM_UNIXTIME(MIN(time))) as `date` FROM `moment` WHERE `moment`.`day_id` = `day`.`id` GROUP BY `moment`.`day_id`);

SET FOREIGN_KEY_CHECKS = 1;
