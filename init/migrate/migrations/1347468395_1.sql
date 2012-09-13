
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `device_notification` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `device_token_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `text` varchar(256) NOT NULL DEFAULT '' COMMENT '' COLLATE armscii8_general_ci,
    `icon` int(2) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `sound` varchar(63) NOT NULL DEFAULT '' COMMENT '' COLLATE armscii8_general_ci,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
