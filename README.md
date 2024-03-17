# Laravel Tour API

Project using Laravel.

## Get started

### Install composer

```
$ composer install
$ cp .env.example .env
```

### Configure your .env file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=db_username
DB_PASSWORD=db_password
```

### Final steps

```
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed

```

## API endpoints

```
1. Auth
2 ) Login -> /api/login
3 ) Logout -> /api/logout

2. Tours
1 ) Get Tours -> /api/tours- GET
1 ) Get ByDateRange Tours -> /api/tours?start_date=2024-04-25&end_date=2024-04-31 - GET
3 ) Create Tour -> /api/tours - POST
4 ) Update Tour -> /api/tours/{id} - PUT OR PATCH
5 ) Delete Tour -> /api/tours/{id} - Delete

3. User
1 ) Get User -> /api/user- GET
2 ) Create User -> /api/user - POST
3 ) Update User -> /api/user/{id} - PUT OR PATCH
4 ) Delete User -> /api/user/{id} - Delete
```

## API POSTMAN KOLLETİON PROJENİN İÇİNDEDİR
