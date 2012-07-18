
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `news` (
    `id` bigint(20) unsigned NOT NULL COMMENT '' auto_increment,
    `recipient_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `title` char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `day_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '',
    `moment_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '',
    `ctime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`),
    INDEX `recipient_id` (`recipient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
