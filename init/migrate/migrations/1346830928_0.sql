
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `complaint` ALTER `ctime`  DROP DEFAULT;#
#  Fieldformat of 'complaint.ctime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



ALTER TABLE `day` DROP `finish_comment_id`;
ALTER TABLE `day` ALTER `ctime`  DROP DEFAULT;#
#  Fieldformat of 'day.ctime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day` ALTER `utime`  DROP DEFAULT;#
#  Fieldformat of 'day.utime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



ALTER TABLE `day_comment` ALTER `user_id`  DROP DEFAULT;#
#  Fieldformat of 'day_comment.user_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_comment` ALTER `day_id`  DROP DEFAULT;#
#  Fieldformat of 'day_comment.day_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_comment` DROP `likes_count`;


DROP TABLE `day_finish_comment`;

ALTER TABLE `day_like` ALTER `ctime`  DROP DEFAULT;#
#  Fieldformat of 'day_like.ctime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



ALTER TABLE `moment` ALTER `time`  DROP DEFAULT;#
#  Fieldformat of 'moment.time' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` ALTER `ctime`  DROP DEFAULT;#
#  Fieldformat of 'moment.ctime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` ALTER `utime`  DROP DEFAULT;#
#  Fieldformat of 'moment.utime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



ALTER TABLE `moment_comment` ALTER `user_id`  DROP DEFAULT;#
#  Fieldformat of 'moment_comment.user_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` ALTER `moment_id`  DROP DEFAULT;#
#  Fieldformat of 'moment_comment.moment_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` DROP `likes_count`;


ALTER TABLE `news` ALTER `sender_id`  DROP DEFAULT;#
#  Fieldformat of 'news.sender_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



ALTER TABLE `news_recipient` ALTER `news_id`  DROP DEFAULT;#
#  Fieldformat of 'news_recipient.news_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `news_recipient` ALTER `user_id`  DROP DEFAULT;#
#  Fieldformat of 'news_recipient.user_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



SET FOREIGN_KEY_CHECKS = 1;
