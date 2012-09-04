
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `news_recipient` ADD `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER news_id;
ALTER TABLE `news_recipient` DROP `recipient_id`;

SET FOREIGN_KEY_CHECKS = 1;
