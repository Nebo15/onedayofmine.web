
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `sphinx_counter` (
    `counter_id` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '',
    `max_doc_id` int(11) NOT NULL DEFAULT 0 COMMENT '',
    UNIQUE `counter_id` (`counter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
