
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `news_recipient` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `news_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `is_pushed` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `complaint` MODIFY `day_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
#
#  Fieldformat of 'complaint.day_id' changed from 'int(11) NULL DEFAULT NULL COMMENT '' to int(11) unsigned NULL DEFAULT NULL COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `complaint` MODIFY `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'complaint.ctime' changed from 'int(11) NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `complaint` ALTER `cip`  DROP DEFAULT;#
#  Fieldformat of 'complaint.cip' changed from 'int(11) NOT NULL DEFAULT '0' COMMENT '' to int(11) NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



ALTER TABLE `day` ADD `final_description` varchar(1023) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER occupation;
ALTER TABLE `day` MODIFY `twitter_id` varchar(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'day.twitter_id' changed from 'varchar(100) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci to varchar(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `day` MODIFY `is_deleted` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '';
#
#  Fieldformat of 'day.is_deleted' changed from 'int(1) unsigned NULL DEFAULT '0' COMMENT '' to int(1) unsigned NOT NULL DEFAULT '0' COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day` MODIFY `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'day.ctime' changed from 'int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day` MODIFY `utime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'day.utime' changed from 'int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day` ADD INDEX `user_id` (`user_id`);
ALTER TABLE `day` ADD INDEX `is_deleted` (`is_deleted`);


ALTER TABLE `day_comment` MODIFY `id` int(11) unsigned NOT NULL COMMENT '' auto_increment;
#
#  Fieldformat of 'day_comment.id' changed from 'int(10) unsigned NOT NULL COMMENT '' auto_increment to int(11) unsigned NOT NULL COMMENT '' auto_increment. Possibly data modifications needed!
#

ALTER TABLE `day_comment` MODIFY `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'day_comment.user_id' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_comment` MODIFY `day_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'day_comment.day_id' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_comment` ALTER `ctime`  DROP DEFAULT;#
#  Fieldformat of 'day_comment.ctime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_comment` ALTER `utime`  DROP DEFAULT;#
#  Fieldformat of 'day_comment.utime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_comment` ALTER `cip`  DROP DEFAULT;#
#  Fieldformat of 'day_comment.cip' changed from 'int(11) NOT NULL DEFAULT '0' COMMENT '' to int(11) NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#



DROP TABLE IF EXISTS `day_comment_like`;
CREATE TABLE `day_comment_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `day_comment_id` int(11) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-day_comment_id` (`user_id`,`day_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `day_favourite`;
CREATE TABLE `day_favourite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `day_id` int(11) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-day_id` (`user_id`,`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




ALTER TABLE `day_interest` ALTER `day_id`  DROP DEFAULT;#
#  Fieldformat of 'day_interest.day_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#


DROP TABLE IF EXISTS `day_like`;
CREATE TABLE `day_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `day_id` int(11) unsigned NOT NULL,
  `facebook_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `twitter_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-day_id` (`user_id`,`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE `moment` ALTER `day_id`  DROP DEFAULT;#
#  Fieldformat of 'moment.day_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` MODIFY `location_latitude` float NULL DEFAULT NULL COMMENT '';
#
#  Fieldformat of 'moment.location_latitude' changed from 'float NOT NULL DEFAULT '0' COMMENT '' to float NULL DEFAULT NULL COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` MODIFY `location_longitude` float NULL DEFAULT NULL COMMENT '';
#
#  Fieldformat of 'moment.location_longitude' changed from 'float NOT NULL DEFAULT '0' COMMENT '' to float NULL DEFAULT NULL COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` MODIFY `time` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'moment.time' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` ALTER `timezone`  DROP DEFAULT;#
#  Fieldformat of 'moment.timezone' changed from 'int(4) NOT NULL DEFAULT '0' COMMENT '' to int(4) NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` MODIFY `facebook_id` char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'moment.facebook_id' changed from 'varchar(16) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci to char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `moment` MODIFY `twitter_id` char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'moment.twitter_id' changed from 'varchar(100) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci to char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `moment` MODIFY `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'moment.ctime' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` MODIFY `utime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'moment.utime' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` ALTER `cip`  DROP DEFAULT;#
#  Fieldformat of 'moment.cip' changed from 'int(11) NOT NULL DEFAULT '0' COMMENT '' to int(11) NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment` ADD INDEX `day_id` (`day_id`);


ALTER TABLE `moment_comment` MODIFY `id` int(11) unsigned NOT NULL COMMENT '' auto_increment;
#
#  Fieldformat of 'moment_comment.id' changed from 'int(10) unsigned NOT NULL COMMENT '' auto_increment to int(11) unsigned NOT NULL COMMENT '' auto_increment. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` MODIFY `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'moment_comment.user_id' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` MODIFY `moment_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'moment_comment.moment_id' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` ALTER `ctime`  DROP DEFAULT;#
#  Fieldformat of 'moment_comment.ctime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` ALTER `utime`  DROP DEFAULT;#
#  Fieldformat of 'moment_comment.utime' changed from 'int(10) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` ALTER `cip`  DROP DEFAULT;#
#  Fieldformat of 'moment_comment.cip' changed from 'int(11) NOT NULL DEFAULT '0' COMMENT '' to int(11) NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_comment` ADD INDEX `moment_id` (`moment_id`);


DROP TABLE IF EXISTS `moment_comment_like`;
CREATE TABLE `moment_comment_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `moment_comment_id` int(11) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-moment_comment_id` (`user_id`,`moment_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `moment_like`;
CREATE TABLE `moment_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `moment_id` int(11) unsigned NOT NULL,
  `facebook_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `twitter_id` char(20) COLLATE utf8_bin DEFAULT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id-moment_it` (`user_id`,`moment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE `news` DROP INDEX recipient_id;
ALTER TABLE `news` ADD `sender_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER id;
ALTER TABLE `news` ADD `day_comment_id` int(11) unsigned NULL DEFAULT NULL COMMENT '' AFTER moment_id;
ALTER TABLE `news` ADD `moment_comment_id` int(11) unsigned NULL DEFAULT NULL COMMENT '' AFTER day_comment_id;
ALTER TABLE `news` DROP `recipient_id`;
ALTER TABLE `news` MODIFY `user_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
#
#  Fieldformat of 'news.user_id' changed from 'int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' to int(11) unsigned NULL DEFAULT NULL COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `news` MODIFY `day_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
#
#  Fieldformat of 'news.day_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NULL DEFAULT NULL COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `news` MODIFY `moment_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
#
#  Fieldformat of 'news.moment_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NULL DEFAULT NULL COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `news` MODIFY `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'news.ctime' changed from 'int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `news` ADD INDEX `user_id-id` (`sender_id`, `id`);


ALTER TABLE `schema_info` DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


ALTER TABLE `user` MODIFY `user_settings_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
#
#  Fieldformat of 'user.user_settings_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NULL DEFAULT NULL COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `name` char(100) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.name' changed from 'varchar(100) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(100) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `email` char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.email' changed from 'varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `facebook_uid` char(20) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.facebook_uid' changed from 'varchar(16) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(20) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `facebook_access_token` char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.facebook_access_token' changed from 'varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `facebook_profile_utime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'user.facebook_profile_utime' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `user` ALTER `timezone`  DROP DEFAULT;#
#  Fieldformat of 'user.timezone' changed from 'int(4) NOT NULL DEFAULT '0' COMMENT '' to int(4) NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `twitter_uid` char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.twitter_uid' changed from 'int(15) unsigned NOT NULL DEFAULT '0' COMMENT '' to char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `twitter_access_token` char(255) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.twitter_access_token' changed from 'varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(255) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `twitter_access_token_secret` char(255) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.twitter_access_token_secret' changed from 'varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(255) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `location` char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.location' changed from 'varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `occupation` char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'user.occupation' changed from 'varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#

ALTER TABLE `user` ALTER `current_day_id`  DROP DEFAULT;#
#  Fieldformat of 'user.current_day_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'user.ctime' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `user` MODIFY `utime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '';
#
#  Fieldformat of 'user.utime' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(10) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

DROP TABLE IF EXISTS `user_following`;
CREATE TABLE `user_following` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `follower_user_id` int(11) unsigned NOT NULL,
  `ctime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `follower_user_id-user_id` (`follower_user_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE `user_settings` ADD `notifications_new_replays` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER notifications_new_comments;


SET FOREIGN_KEY_CHECKS = 1;
