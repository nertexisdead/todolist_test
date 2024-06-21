
## Инструкция по развертыванию репозитория и настройке окружения

## Клонирование репозитория:

Необходимо иметь локально: PHP 8+, Composer 2+, Node 16+, npm 8+.

Перейти в папку где хотите развернуть проект

git clone https://github.com/nertexisdead/todolist_test.git
cd todolist_test

## Настройка .env файла:

Создайте файл .env на основе примера .env.example:
cp .env.example .env

Откройте файл .env и настройте его параметры в соответствии с вашей системой, особенно параметры подключения к базе данных (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD). Пример:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

APP_URL=http://localhost:8000

## Создание базы данных:

Убедитесь, что вы создали базу данных с именем, указанным в .env файле.

## Установка зависимостей:

Убедитесь, что у вас установлен Composer.
Затем выполните команду для установки зависимостей проекта:

composer install

## Генерация ключа приложения:

php artisan key:generate

## Запуск миграций:

php artisan migrate

## Запуск сервера:

Чтобы запустить сервер разработки Laravel, выполните команду:

php artisan serve

Сервер будет запущен на порту, указанном в .env файле (по умолчанию это http://localhost:8000).

