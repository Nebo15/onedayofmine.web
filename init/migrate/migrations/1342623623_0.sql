
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `news` ADD `text` char(255) NOT NULL DEFAULT '' COMMENT '' COLLATE utf8_general_ci AFTER user_id;
ALTER TABLE `news` DROP `title`;


SET FOREIGN_KEY_CHECKS = 1;
