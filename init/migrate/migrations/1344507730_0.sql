
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` MODIFY `type` enum('Working day','Day off','Holiday','Trip','Special event') NOT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'day.type' changed from 'enum('Working','Day-off','Holiday','Trip','Special event') NOT NULL COMMENT '' COLLATE utf8_general_ci to enum('Working day','Day off','Holiday','Trip','Special event') NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#



SET FOREIGN_KEY_CHECKS = 1;
