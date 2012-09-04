
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` MODIFY `timezone` int(4) NOT NULL DEFAULT '0' COMMENT '';
#
#  Fieldformat of 'user.timezone' changed from 'int(2) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(4) NOT NULL DEFAULT '0' COMMENT ''. Possibly data modifications needed!
#



SET FOREIGN_KEY_CHECKS = 1;
