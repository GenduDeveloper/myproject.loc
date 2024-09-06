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

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`)
VALUES (NULL, 'admin', 'admin@gmail.com', '1', 'admin', 'hash1', 'token1', CURRENT_TIMESTAMP);
INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`)
VALUES (NULL, 'user', 'user@gmail.com', '1', 'user', 'hash2', 'token2', CURRENT_TIMESTAMP);

CREATE TABLE `articles`
(
    `id`         INT(11) NOT NULL AUTO_INCREMENT,
    `author_id`  INT(11) NOT NULL,
    `name`       VARCHAR(255) NOT NULL,
    `text`       TEXT         NOT NULL,
    `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`)
VALUES (NULL, '1', 'Победа "Зенита" над "Спартаком"',
        'В напряженном матче на "Газпром Арене" "Зенит" одержал волевую победу над "Спартаком" со счетом 2:1. Голы забили Дзюба и Малком. Это важная победа для "Зенита" в борьбе за чемпионство.',
        CURRENT_TIMESTAMP);

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`)
VALUES (NULL, '1', 'Обзор матча "Локомотив" - "Краснодар"',
        'В интересном матче на "РЖД Арене" "Локомотив" и "Краснодар" сыграли вничью 1:1. Голы забили Смолов и Сулейманов. Ничья закономерна, обе команды имели шансы победить.',
        CURRENT_TIMESTAMP);

INSERT INTO `articles` (`id`, `author_id`, `name`, `text`, `created_at`)
VALUES (NULL, '2', 'Обзор матча "Рубин" - "Ахмат"',
        'В матче 7-го тура РПЛ "Рубин" на своем поле принимал "Ахмат". Встреча завершилась победой казанцев со счетом 2:1. Голы забили Деспотович и Тарасов для "Рубина", Бериша отличился у грозненцев. Победа позволила "Рубину" подняться на 6-е место в турнирной таблице.',
        CURRENT_TIMESTAMP);

