
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day_like` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `day_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `fb_id` varchar(20) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `cip` int(11) NOT NULL DEFAULT 0 COMMENT '',
    `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`),
    INDEX `user_id` (`user_id`, `day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `moment_like` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `moment_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `fb_id` varchar(20) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `cip` int(11) NOT NULL DEFAULT 0 COMMENT '',
    `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`),
    INDEX `user_id` (`user_id`, `moment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `day` ADD `twitter_id` varchar(100) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER fb_id;


ALTER TABLE `moment` ADD `twitter_id` varchar(100) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER fb_id;
ALTER TABLE `moment` ADD `is_deleted` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER twitter_id;
ALTER TABLE `moment` MODIFY `fb_id` varchar(16) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'moment.fb_id' changed from 'varchar(16) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci to varchar(16) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#



SET FOREIGN_KEY_CHECKS = 1;
