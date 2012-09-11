
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `device_token` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `token` varchar(128) NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_general_ci,
    `ctime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `logins_count` int(5) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`),
    UNIQUE `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
