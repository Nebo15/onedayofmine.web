
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` MODIFY `id` int(11) unsigned NOT NULL COMMENT '' auto_increment;
#
#  Fieldformat of 'user.id' changed from 'int(11) NOT NULL COMMENT '' auto_increment to int(11) unsigned NOT NULL COMMENT '' auto_increment. Possibly data modifications needed!
#

SET FOREIGN_KEY_CHECKS = 1;
