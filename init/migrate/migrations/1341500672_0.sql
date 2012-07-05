SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `name` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER id;
ALTER TABLE `user` ADD `fb_profile_url` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER fb_access_token;
ALTER TABLE `user` ADD `fb_profile_utime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER fb_profile_url;
ALTER TABLE `user` ADD `fb_timezone` int(2) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER fb_profile_utime;
ALTER TABLE `user` ADD `pic_big` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER fb_timezone;
ALTER TABLE `user` ADD `pic_square` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER pic_big;
ALTER TABLE `user` ADD `pic_small` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER pic_square;
ALTER TABLE `user` ADD `sex` enum('male','female') COLLATE utf8_general_ci AFTER pic_small;
ALTER TABLE `user` MODIFY `ctime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '';
ALTER TABLE `user` MODIFY `utime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '';

SET FOREIGN_KEY_CHECKS = 1;
