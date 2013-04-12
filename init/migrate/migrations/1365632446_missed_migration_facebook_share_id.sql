
SET FOREIGN_KEY_CHECKS = 0;

DROP INDEX `facebook_uid` ON `day`;
ALTER TABLE `day` ADD `facebook_share_id` varchar(20) NULL DEFAULT NULL AFTER user_id;
ALTER TABLE `day` ADD `twitter_share_id` varchar(20) NULL DEFAULT NULL AFTER facebook_share_id;
ALTER TABLE `day` DROP `facebook_id`;
ALTER TABLE `day` DROP `twitter_id`;
ALTER TABLE day ADD UNIQUE `facebook_share_id` (`facebook_share_id`);

SET FOREIGN_KEY_CHECKS = 1;
