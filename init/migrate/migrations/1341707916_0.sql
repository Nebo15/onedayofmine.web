
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `user` ADD `birthday` date NOT NULL AFTER occupation;

SET FOREIGN_KEY_CHECKS = 1;