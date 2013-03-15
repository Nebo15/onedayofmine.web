
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `invitation` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `code` varchar(20) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci,
    `max_count` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `taken_count` int(11) unsigned NULL DEFAULT '0' COMMENT '',
    `ctime` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    `utime` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    PRIMARY KEY (`id`),
    UNIQUE `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `user` ADD `invitation_id` int(11) unsigned NULL DEFAULT NULL COMMENT '' AFTER id;

INSERT INTO `invitation` (`id`, `code`, `max_count`, `taken_count`, `ctime`, `utime`)
VALUES
	(1,'They shall not pass',100,0,1363379351,1363379351),


SET FOREIGN_KEY_CHECKS = 1;
