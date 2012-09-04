
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `day` (
    `id` int(11) NOT NULL COMMENT '' auto_increment,
    `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '',
    `title` varchar(255) NULL DEFAULT NULL COMMENT '' COLLATE latin1_swedish_ci,
    `description` varchar(1023) NOT NULL DEFAULT '' COMMENT '' COLLATE latin1_swedish_ci,
    `start_time` int(11) NOT NULL DEFAULT 0 COMMENT '',
    `likes_count` int(11) NOT NULL DEFAULT '0' COMMENT '',
    `ctime` int(11) NOT NULL DEFAULT 0 COMMENT '',
    `utime` int(11) NOT NULL DEFAULT 0 COMMENT '',
    `cip` int(11) NOT NULL DEFAULT 0 COMMENT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

SET FOREIGN_KEY_CHECKS = 1;
