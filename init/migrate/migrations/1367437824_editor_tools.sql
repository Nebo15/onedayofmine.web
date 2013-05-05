
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day_journal` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `day_id` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    `user_id` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    `ctime` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    `cip` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `editor_action` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `user_Id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `day_id` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    `moment_id` int(11) unsigned NULL DEFAULT NULL COMMENT '',
    `action` varchar(1024) NOT NULL DEFAULT '',
    `ctime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `cip` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

ALTER TABLE `user` ADD `is_editor` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER user_settings_id;

SET FOREIGN_KEY_CHECKS = 1;
