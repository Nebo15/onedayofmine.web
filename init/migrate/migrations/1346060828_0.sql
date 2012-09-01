
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day_finish_comment` (
    `id` int(10) unsigned NOT NULL COMMENT '' auto_increment,
    `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '',
    `text` varchar(1023) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `likes_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '',
    `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '',
    `utime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '',
    `cip` int(11) NOT NULL DEFAULT '0' COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
