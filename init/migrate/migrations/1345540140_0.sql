
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` DROP `is_ended`;


ALTER TABLE `user` ADD `current_day_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER sex;


SET FOREIGN_KEY_CHECKS = 1;
