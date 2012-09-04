
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `user_settings` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `notifications_new_days` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `notifications_new_comments` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `notifications_related_activity` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `notifications_shooting_photos` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `photos_save_original` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `photos_save_filtered` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `user` ADD `user_settings_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER id;


SET FOREIGN_KEY_CHECKS = 1;
