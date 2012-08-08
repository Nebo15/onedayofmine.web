
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` MODIFY `type` enum('Working','Day-off','Holiday','Trip','Special event') NOT NULL COLLATE utf8_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
