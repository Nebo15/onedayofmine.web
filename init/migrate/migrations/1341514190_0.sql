
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `moment` MODIFY `image_ext` varchar(11) NOT NULL DEFAULT '0' COMMENT '' COLLATE utf8_general_ci;
#
#  Fieldformat of 'moment.image_ext' changed from 'int(11) NOT NULL DEFAULT '0' COMMENT '' to varchar(11) NOT NULL DEFAULT '0' COMMENT '' COLLATE utf8_general_ci. Possibly data modifications needed!
#



ALTER TABLE `user` ADD `timezone` int(2) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER fb_profile_utime;
ALTER TABLE `user` ADD `fb_pic_big` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER timezone;
ALTER TABLE `user` ADD `fb_pic_square` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER fb_pic_big;
ALTER TABLE `user` ADD `fb_pic_small` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER fb_pic_square;
ALTER TABLE `user` DROP `fb_timezone`;
ALTER TABLE `user` DROP `pic_big`;
ALTER TABLE `user` DROP `pic_square`;
ALTER TABLE `user` DROP `pic_small`;


SET FOREIGN_KEY_CHECKS = 1;
