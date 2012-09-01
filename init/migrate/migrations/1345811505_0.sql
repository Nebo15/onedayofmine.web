
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `finish_comment_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER fb_id;


SET FOREIGN_KEY_CHECKS = 1;
