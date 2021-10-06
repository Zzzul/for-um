# FOR-UM
Mini forum built on Laravel.

## Demo
[Here](https://laravel-for-um.herokuapp.com/)

## What inside?
- Laravel ^8.x - [Laravel 8](https://laravel.com/docs/8.x)
- Laravel UI ^3.x - [Laravel/ui](https://github.com/laravel/ui/tree/3.x)
- Bootswatch ^4.x (Bootstrap custom theme) - [Bootswatch/4/lumen](https://bootswatch.com/4/lumen/)

## Installation
Clone or download this repository
```shell
$ git clone https://github.com/Zzzul/for-um.git
```

Install all dependencies
```shell
# install laravel dependency
$ composer install
```

Generate app key, configure `.env` file and do migration.
```shell
# create copy of .env
$ cp .env.example .env

# set .env email for notification 
$ MAIL_MAILER=smtp
$ MAIL_HOST=smtp.mailtrap.io
$ MAIL_PORT=2525
$ MAIL_USERNAME=YOUR_USERNAME
$ MAIL_PASSWORD=YOUR_PASSWORD
$ MAIL_ENCRYPTION=tls
$ MAIL_FROM_ADDRESS="noreply@example.com"
$ MAIL_FROM_NAME="${APP_NAME}"

# set queue connection
$ QUEUE_CONNECTION=database

# create laravel key
$ php artisan key:generate

# laravel migrate
$ php artisan migrate

# Start local development server
$ php artisan serve

# run queue on other terminal
$ php artisan queue:work
```

## License
MIT
