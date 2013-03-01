SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `instagram_uid` char(64) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER twitter_access_token_secret;
ALTER TABLE `user` ADD `instagram_token` char(64) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER instagram_uid;

SET FOREIGN_KEY_CHECKS = 1;
