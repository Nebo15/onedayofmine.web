
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `timezone` tinyint(12) NOT NULL DEFAULT '0' COMMENT '' AFTER is_ended;
ALTER TABLE `day` MODIFY `type` enum('working','day-off','holiday','trip','special-event') NOT NULL COLLATE utf8_general_ci;
ALTER TABLE `day` DROP `time_offset`;

SET FOREIGN_KEY_CHECKS = 1;
