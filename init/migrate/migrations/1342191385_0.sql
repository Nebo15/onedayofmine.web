
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` MODIFY `type` enum('working','day-off','holiday','trip','special_event') NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'day.type' changed from 'enum('working','day-off','holiday','trip','special-event') NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to enum('working','day-off','holiday','trip','special_event') NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#



SET FOREIGN_KEY_CHECKS = 1;
