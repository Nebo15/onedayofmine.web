
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `news` ALTER `recipient_id`  DROP DEFAULT;
#
#  Fieldformat of 'news.recipient_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `news` ALTER `user_id`  DROP DEFAULT;
#
#  Fieldformat of 'news.user_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `news` ALTER `ctime`  DROP DEFAULT;
#
#  Fieldformat of 'news.ctime' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

SET FOREIGN_KEY_CHECKS = 1;
