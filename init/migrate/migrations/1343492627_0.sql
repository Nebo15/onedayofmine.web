
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `twitter_uid` int(15) unsigned NOT NULL DEFAULT '0' COMMENT '' AFTER fb_pic_small;


SET FOREIGN_KEY_CHECKS = 1;
