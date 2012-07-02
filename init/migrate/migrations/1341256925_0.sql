
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day_favourite` (
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `day_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `ctime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`user_id`, `day_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `user_following` (
    `user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `follower_user_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `ctime` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`follower_user_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
