
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` MODIFY `email` varchar(255) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.email' changed from 'varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to varchar(255) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#



SET FOREIGN_KEY_CHECKS = 1;
