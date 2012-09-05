
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `news_recipient` (
    `id` int(11) unsigned NOT NULL COMMENT '' auto_increment,
    `news_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `recipient_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `is_pushed` int(1) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `news` DROP INDEX recipient_id;

ALTER TABLE `news` ADD `sender_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '' AFTER id;
ALTER TABLE `news` DROP `recipient_id`;
ALTER TABLE `news` MODIFY `user_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
ALTER TABLE `news` MODIFY `day_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
ALTER TABLE `news` MODIFY `moment_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
ALTER TABLE `news` MODIFY `day_comment_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';
ALTER TABLE `news` MODIFY `moment_comment_id` int(11) unsigned NULL DEFAULT NULL COMMENT '';

ALTER TABLE `news` ADD INDEX `user_id_id` (`sender_id`, `id`);

SET FOREIGN_KEY_CHECKS = 1;
