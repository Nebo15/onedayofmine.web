
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day_comment` (
    `id` int(10) unsigned NOT NULL COMMENT '' auto_increment,
    `user_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `day_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `text` varchar(1023) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `likes_count` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `utime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `cip` int(11) NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `moment` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `day_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `description` varchar(1023) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `type` enum('video','photo') NOT NULL COLLATE utf8_general_ci,
    `fb_id` varchar(16) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `likes_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '',
    `ctime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `utime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `cip` int(11) NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `moment_comment` (
    `id` int(10) unsigned NOT NULL COMMENT '' auto_increment,
    `user_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `moment_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `text` varchar(1023) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `likes_count` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `ctime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `utime` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `cip` int(11) NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `day` MODIFY `id` int(11) unsigned NOT NULL auto_increment;
ALTER TABLE `day` MODIFY `user_id` int(11) unsigned NOT NULL;
ALTER TABLE `day` MODIFY `title` varchar(255) NOT NULL COLLATE utf8_general_ci;
ALTER TABLE `day` MODIFY `start_time` int(11) unsigned NOT NULL;
ALTER TABLE `day` MODIFY `likes_count` int(11) unsigned NOT NULL DEFAULT 0;
ALTER TABLE `day` MODIFY `is_deleted` int(1) unsigned NULL DEFAULT 0;
ALTER TABLE `day` MODIFY `ctime` int(11) unsigned NOT NULL;
ALTER TABLE `day` MODIFY `utime` int(11) unsigned NOT NULL;
ALTER TABLE `day` ALTER `cip`  DROP DEFAULT;
ALTER TABLE `day` DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `user` ADD `fb_access_token` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER fb_uid;
ALTER TABLE `user` DROP INDEX id;


SET FOREIGN_KEY_CHECKS = 1;
