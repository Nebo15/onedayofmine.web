
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `moment` MODIFY `timezone` int(4) NOT NULL DEFAULT '0' COMMENT '';
#
#  Fieldformat of 'moment.timezone' changed from 'int(4) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(4) NOT NULL DEFAULT '0' COMMENT ''. Possibly data modifications needed!
#



SET FOREIGN_KEY_CHECKS = 1;
