
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day_favourite` DROP `id`;
ALTER TABLE day_favourite ADD PRIMARY KEY (`user_id`, `day_id`);
ALTER TABLE `day_favourite` DROP INDEX `user_id-day_id`;


SET FOREIGN_KEY_CHECKS = 1;
