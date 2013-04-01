
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `is_opened` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER image_ext;
ALTER TABLE `moment` ADD `is_hidden` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER twitter_id;

SET FOREIGN_KEY_CHECKS = 1;
