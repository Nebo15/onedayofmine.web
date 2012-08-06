
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day_interest` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `day_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `rating` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `is_pinned` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '',
    PRIMARY KEY (`id`),
    UNIQUE `day_id` (`day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
