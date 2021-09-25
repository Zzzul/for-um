web: vendor/bin/heroku-php-apache2 public/
worker: php artisan queue:restart && php artisan queue:retry all && php artisan queue:work --tries=3
