#!/bin/sh

cd /var/www

find bootstrap/cache ! -name .gitignore -exec chmod 777 {} \;
find storage ! -name .gitignore -exec chmod 777 {} \;

sh -c "composer install; php artisan migrate; if [ -z \$(grep '^APP_KEY=.\{10,\}' .env) ]; then php artisan key:generate; fi" &
sh -c "php artisan storage:link" &

npm config set strict-ssl=false && npm install && npm run build &

service cron start

supervisord -c /etc/supervisor/supervisord.conf

exec apache2-foreground
