
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` DROP `likes_count`;


ALTER TABLE `moment` DROP `likes_count`;

SET FOREIGN_KEY_CHECKS = 1;
