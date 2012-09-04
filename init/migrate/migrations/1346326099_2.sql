
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `news` ADD `day_comment_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER moment_id;
ALTER TABLE `news` ADD `moment_comment_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER day_comment_id;

SET FOREIGN_KEY_CHECKS = 1;
