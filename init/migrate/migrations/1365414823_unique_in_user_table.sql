
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` DROP INDEX facebook_uid;
ALTER TABLE `user` DROP INDEX facebook_access_token;

ALTER TABLE `user` ADD UNIQUE `facebook_uid` (`facebook_uid`);
ALTER TABLE `user` ADD UNIQUE `facebook_access_token` (`facebook_access_token`);


SET FOREIGN_KEY_CHECKS = 1;
