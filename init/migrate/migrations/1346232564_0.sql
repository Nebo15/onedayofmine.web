
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day_comment_like` (
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `day_comment_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `fb_id` varchar(20) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '',
    PRIMARY KEY (`user_id`, `day_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `moment_comment_like` (
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `moment_comment_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `fb_id` varchar(29) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '',
    PRIMARY KEY (`user_id`, `moment_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `day_like` DROP `id`;
ALTER TABLE `day_like` ALTER `user_id`  DROP DEFAULT;#
#  Fieldformat of 'day_like.user_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_like` ALTER `day_id`  DROP DEFAULT;#
#  Fieldformat of 'day_like.day_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `day_like` DROP `cip`;
ALTER TABLE `day_like` ADD PRIMARY KEY (`user_id`, `day_id`);
ALTER TABLE `day_like` DROP INDEX user_id;


ALTER TABLE `moment_like` DROP `id`;
ALTER TABLE `moment_like` ALTER `user_id`  DROP DEFAULT;#
#  Fieldformat of 'moment_like.user_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_like` ALTER `moment_id`  DROP DEFAULT;#
#  Fieldformat of 'moment_like.moment_id' changed from 'int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' to int(11) unsigned NOT NULL DEFAULT 0 COMMENT ''. Possibly data modifications needed!
#

ALTER TABLE `moment_like` DROP `cip`;
ALTER TABLE `moment_like` ADD PRIMARY KEY (`user_id`, `moment_id`);
ALTER TABLE `moment_like` DROP INDEX user_id;


SET FOREIGN_KEY_CHECKS = 1;
