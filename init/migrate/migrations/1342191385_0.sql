
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` MODIFY `type` enum('working','day-off','holiday','trip','special_event') NOT NULL COMMENT '' COLLATE utf8_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
