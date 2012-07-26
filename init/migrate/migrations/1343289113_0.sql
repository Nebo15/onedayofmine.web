
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `name` varchar(100) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER user_settings_id;
ALTER TABLE `user` DROP `first_name`;
ALTER TABLE `user` DROP `last_name`;


ALTER TABLE `user_settings` ADD `social_share_facebook` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER photos_save_filtered;
ALTER TABLE `user_settings` ADD `social_share_twitter` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER social_share_facebook;


SET FOREIGN_KEY_CHECKS = 1;
