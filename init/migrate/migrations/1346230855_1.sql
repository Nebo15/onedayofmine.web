SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `requests_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ctime` int(11) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) COLLATE ascii_bin NOT NULL DEFAULT '',
  `method` varchar(7) COLLATE ascii_bin NOT NULL DEFAULT '',
  `path` varchar(255) COLLATE ascii_bin NOT NULL DEFAULT '',
  `get` text COLLATE ascii_bin NOT NULL,
  `post` text COLLATE ascii_bin NOT NULL,
  `cookies` text COLLATE ascii_bin NOT NULL,
  `code` int(3) unsigned NOT NULL DEFAULT '0',
  `response` text COLLATE ascii_bin NOT NULL,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=ascii COLLATE=ascii_bin;

SET FOREIGN_KEY_CHECKS = 1;
