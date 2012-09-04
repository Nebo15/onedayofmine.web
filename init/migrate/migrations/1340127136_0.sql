
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `time_offset` tinyint(12) NOT NULL DEFAULT 0 AFTER description;
ALTER TABLE `day` DROP `top_moment_id`;
ALTER TABLE `day` DROP `start_time`;

SET FOREIGN_KEY_CHECKS = 1;
