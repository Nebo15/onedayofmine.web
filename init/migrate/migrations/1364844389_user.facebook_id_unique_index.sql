SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD UNIQUE `facebook_uid` (`facebook_id`);

SET FOREIGN_KEY_CHECKS = 1;
