
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `location` varchar(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER fb_pic_small;


SET FOREIGN_KEY_CHECKS = 1;
