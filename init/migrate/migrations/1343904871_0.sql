
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `image_ext` varchar(4) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER email;
ALTER TABLE `user` DROP `fb_pic_big`;
ALTER TABLE `user` DROP `fb_pic_square`;
ALTER TABLE `user` DROP `fb_pic_small`;

SET FOREIGN_KEY_CHECKS = 1;
