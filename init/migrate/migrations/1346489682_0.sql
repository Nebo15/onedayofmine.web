
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `facebook_id` varchar(20) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER user_id;
ALTER TABLE `day` DROP `fb_id`;


-- ALTER TABLE `day_comment_like` DROP `fb_id`;


ALTER TABLE `day_like` DROP `fb_id`;


ALTER TABLE `moment` ADD `facebook_id` varchar(16) NULL DEFAULT NULL COMMENT '' COLLATE utf8_general_ci AFTER timezone;
ALTER TABLE `moment` DROP `fb_id`;


-- ALTER TABLE `moment_comment_like` DROP `fb_id`;


ALTER TABLE `moment_like` DROP `fb_id`;


ALTER TABLE `user` DROP INDEX fb_uid;
ALTER TABLE `user` DROP INDEX fb_access_token;
ALTER TABLE `user` DROP `fb_uid`;
ALTER TABLE `user` DROP `fb_access_token`;
ALTER TABLE `user` DROP `fb_profile_utime`;
ALTER TABLE `user` ADD `facebook_uid` varchar(16) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER image_ext;
ALTER TABLE `user` ADD `facebook_access_token` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER facebook_uid;
ALTER TABLE `user` ADD `facebook_profile_utime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER facebook_access_token;
ALTER TABLE user ADD INDEX `facebook_uid` (`facebook_uid`);
ALTER TABLE user ADD INDEX `facebook_access_token` (`facebook_access_token`);


SET FOREIGN_KEY_CHECKS = 1;
