Инструкция по разворачиванию проекта

1. Клонировать проект с репозитория git clone https://github.com/sub3er0/pixel.git .
2. Установить laravel (cd app) composer create-project --prefer-dist laravel/laravel .
3. docker compose up -d
4. sudo chmod -R 777 . из корня проекта
5. В файле app/.env установить правильные доступы:
```
DB_CONNECTION=mysql
DB_HOST=alef_db
DB_PORT=3306
DB_DATABASE=dbname
DB_USERNAME=username
DB_PASSWORD=password
```
6. Выполнить php artisan migrate

Папки и файлы, содержащие код задания:
- Описание api маршрутов: api.php
- Сервисы: app/Services
- Контроллеры app/Http/Controllers
- Запросы app/Http/Requests
- Модели app/Http/Models