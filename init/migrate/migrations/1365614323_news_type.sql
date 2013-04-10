SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `news` ADD `type` enum('day_created','day_comment','day_liked','day_shared','day_favorite','day_gathering','moment_created','moment_commented','moment_liked','user_followed','user_fbfriend') NULL DEFAULT NULL AFTER text;

SET FOREIGN_KEY_CHECKS = 1;
