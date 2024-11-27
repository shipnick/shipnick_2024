#!/bin/bash
echo "Starting local development server"

# /c/wamp64/bin/php/php7.4.33/php composer.phar install

/c/wamp64/bin/php/php7.4.33/php composer.phar dump-autoload

/c/wamp64/bin/php/php7.4.33/php artisan optimize:clear
start "http://localhost:7012"
npm run dev & /c/wamp64/bin/php/php7.4.33/php artisan migrate
npm run dev & /c/wamp64/bin/php/php7.4.33/php artisan serve --port=7012
