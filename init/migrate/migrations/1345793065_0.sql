
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `requests_log`;
CREATE TABLE `requests_log` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_bin,
    `method` varchar(7) NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_bin,
    `path` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_bin,
    `get` text NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_bin,
    `post` text NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_bin,
    `cookies` text NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_bin,
    `code` int(3) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `response` text NOT NULL DEFAULT '' COMMENT '' COLLATE ascii_bin,
    `time` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

SET FOREIGN_KEY_CHECKS = 1;
