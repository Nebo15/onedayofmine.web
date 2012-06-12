
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `complaint` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `user_id` int(11) NULL DEFAULT NULL COMMENT '',
    `text` varchar(1023) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_bin,
    `day_id` int(11) NULL DEFAULT NULL COMMENT '',
    `moment_id` int(11) NULL DEFAULT NULL COMMENT '',
    `ctime` int(11) NOT NULL DEFAULT 0 COMMENT '',
    `cip` int(11) NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
