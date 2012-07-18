
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `twitter_access_token` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER fb_pic_small;
ALTER TABLE `user` ADD `twitter_access_token_secret` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER twitter_access_token;


SET FOREIGN_KEY_CHECKS = 1;
