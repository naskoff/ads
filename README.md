<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Installation

Clone the repo locally:
```shell
git clone git@github.com:naskoff/ads.git ads
```

Install PHP dependencies:
```shell
composer install
```

Setup configuration:
```shell
cp .env.example .env
```

Generate application key:
```shell
php artisan key:generate
```

Start application
```shell
./vendor/bin/sail up -d
```

Run database migrations:
```shell
./vendor/bin/sail artisan migrate
```

Run database seeder:
```sh
./vendor/bin/sail artisan db:seed
```

> **Note** DB seeders create these accounts for testing purpose:

### User with Super Admin role
-   **Username:** super-admin@ads.dev
-   **Password:** super-admin

### User with Admin role
-   **Username:** admin@ads.dev
-   **Password:** admin

### User with Editor role
-   **Username:** editor@ads.dev
-   **Password:** editor

### User with Viewer role
-   **Username:** viewer@ads.dev
-   **Password:** viewer

> **Note** If you do not want to use sail, change variables in .env file and run command omit ./vendor/bin/sail

