SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `moment` ADD `instagram_id` char(32) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER twitter_id;

SET FOREIGN_KEY_CHECKS = 1;
