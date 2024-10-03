
# Учебный проект
Футбольный блог, разработанный с использованием самописного MVC-фреймворка в рамках [курса по ООП](https://php.zone/oop-v-php-prodvinutyj-kurs) на PHP.
## Реализовано:
- Базовый `CRUD`
- Регистрация
- Подтверждение регистрации с помощью библиотеки `PHPMailer`
- Авторизация по токенам
- Пагинация статей
- Админка
- Профиль пользователя
- Комментарии
## Использованные технологии:
 - `PHP 8.0`
 - `HTML/CSS`
 - Архитектура `MVC`
 - Паттерны проектирования: `ActiveRecord`, `Singleton`
 - Технология `ORM`
 - `MySQL`
 - `Git`
 - `Composer`

Шаблон взят [здесь](https://github.com/dawidolko/Website-Templates/tree/master/startbootstrap-clean-blog-1.0.2)
## Разворачивание проекта:
1. Клонируйте репозиторий:

      `git clone https://github.com/GenduDeveloper/myproject.loc.git`
2. В корне проекта:

    `composer install`
3. Настройки базы данных должны находится в `src/settings.php`
