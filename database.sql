CREATE TABLE `users`
(
    `id`            INT(11) NOT NULL AUTO_INCREMENT,
    `nickname`      VARCHAR(128) NOT NULL UNIQUE,
    `email`         VARCHAR(255) NOT NULL UNIQUE,
    `is_confirmed`  TINYINT(1) NOT NULL DEFAULT '0',
    `role`          ENUM('admin', 'user') NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `auth_token`    VARCHAR(255) NOT NULL,
    `created_at`    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `articles`
(
    `id`         INT(11) NOT NULL AUTO_INCREMENT,
    `author_id`  INT(11) NOT NULL,
    `name`       VARCHAR(255) NOT NULL,
    `text`       TEXT         NOT NULL,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

