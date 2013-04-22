
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `news_recipient` ADD `is_read` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER is_pushed;
ALTER TABLE `user_settings` ADD `notifications_period_fb` enum('now','twice_day','daily','weekly','never') NOT NULL DEFAULT 'twice_day' COMMENT '' COLLATE utf8_bin AFTER id;

SET FOREIGN_KEY_CHECKS = 1;
