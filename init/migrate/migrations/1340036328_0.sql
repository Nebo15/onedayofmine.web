
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `moment` ADD `image_ext` int(11) NOT NULL DEFAULT 0 COMMENT '' AFTER description;
ALTER TABLE `moment` DROP `type`;

ALTER TABLE `user` ADD INDEX `fb_uid` (`fb_uid`);
ALTER TABLE `user` ADD INDEX `fb_access_token` (`fb_access_token`);

SET FOREIGN_KEY_CHECKS = 1;
