
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE  `day` CHANGE  `is_ended`  `is_ended` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

SET FOREIGN_KEY_CHECKS = 1;
