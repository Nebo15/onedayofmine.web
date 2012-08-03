
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `day` ADD `image_ext` enum('jpg','png','gif','jpeg') NULL DEFAULT NULL AFTER type;
ALTER TABLE `moment` MODIFY `image_ext` enum('jpg','jpeg','png','gif') NULL DEFAULT NULL;
ALTER TABLE `user` MODIFY `image_ext` enum('jpg','jpeg','png','gif') NULL DEFAULT NULL;

SET FOREIGN_KEY_CHECKS = 1;
