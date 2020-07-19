#!/bin/bash
ENV=cd /var/www/html/.env
EXAMPLE=cd /var/www/html/.env.example
    if [ -f "$ENV" ]
    then
        echo "$ENV exists, not creating"
    else
        echo "$ENV doesn't exist, checking for example to copy ..."
        if [ -f "$EXAMPLE" ]
        then
            echo "$EXAMPLE does exist, copying to .env"
            cp /var/www/html/.env.example /var/www/html/.env
        else
            echo ".env.example not found, .env not created"
        fi
    fi

echo "running composer install"
cd /var/www/html &&
composer install

echo "generating app key"
cd /var/www/html &&
php artisan key:generate

# echo "remove echo server lock"
# rm laravel-echo-server.lock
echo "create supervisor log file"
touch /var/log/worker.log

echo "starting supervisor"
cd /var/www/html &&
service supervisor start %

echo "starting supervisor jobs"
cd /var/www/html &&
supervisorctl reread
cd /var/www/html &&
supervisorctl update

echo "running migrations"
cd /var/www/html &&
php artisan migrate:install
php artisan migrate

echo "creating filesystem link"
cd /var/www/html &&
php artisan storage:link

# echo "create search index"
# php artisan elastic:create-index "App\MyIndexConfigurator"

apachectl -D FOREGROUND
