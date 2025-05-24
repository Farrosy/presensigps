#!/bin/bash
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan storage:link
php artisan optimize:clear