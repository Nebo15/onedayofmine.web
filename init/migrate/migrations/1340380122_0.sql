SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `complaint` DROP `user_id`;
ALTER TABLE `complaint` DROP `moment_id`;

SET FOREIGN_KEY_CHECKS = 1;
