
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `moment` ADD `flickr_id` char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER instagram_id;
ALTER TABLE `moment` ADD `facebook_post_id` char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER flickr_id;
ALTER TABLE `moment` ADD `twitter_post_id` char(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER facebook_post_id;

SET FOREIGN_KEY_CHECKS = 1;
