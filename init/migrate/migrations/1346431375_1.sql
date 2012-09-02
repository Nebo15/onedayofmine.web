
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user_settings` ADD `notifications_new_replays` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER notifications_new_comments;


SET FOREIGN_KEY_CHECKS = 1;
