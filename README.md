# Prueba Back - Laravel 
Create a new project to manage companies and their employees. 

The backend I used Laravel Lumen
The frontend I used Angular.

# To start the frontend
Run command npm start on /frontend 

# To start laravel
First install Laravel. instructions are at the end of this document.
Run php -S localhost:8000 -t public


# To get the Token 
make a POST request
http://localhost:8081/api/v1/oauth/token

# Use body in Token request change values
grant_type:password
client_id:2
client_secret:yTsjcgxLPmBh4wrss8Fojc5z4U8YEpsvm8Ppcsjb
username:admin@admin.com
password:password


# CRUD functionality (Create / Read / Update / Delete) 


Base endpoints  '/companies' - '/user' - '/employees'

Used enpoints  '/create' - '/search' - '/edit/{id}' - '/exclude/{id}' 

Used to '/searchexcludes' - '/restore/{id}' - '/getbyid'

Exemple to create user 
make a POST request to '/user/create'

Exemple to create company
make a POST request to '/companies/create'

## libs used
*new artisan makes*
[flipbox/lumen-generator](https://packagist.org/packages/flipbox/lumen-generator) - https://packagist.org/packages/flipbox/lumen-generator

*implement publish artisan*
[laravelista/lumen-vendor-publish](https://packagist.org/packages/laravelista/lumen-vendor-publish) - https://packagist.org/packages/laravelista/lumen-vendor-publish

 *create documentation for API in an automated way*
[mpociot/laravel-apidoc-generator](https://github.com/mpociot/laravel-apidoc-generator) - https://github.com/mpociot/laravel-apidoc-generator

*work with custom request in controller*
[pearl/lumen-request-validate](https://github.com/pearlkrishn/lumen-request-validate) - https://github.com/pearlkrishn/lumen-request-validate

*user authentication via token*
[dusterio/lumen-passport](https://github.com/dusterio/lumen-passport) - https://github.com/dusterio/lumen-passport

*ACL*
[spatie/laravel-permission](https://github.com/spatie/laravel-permission) - https://github.com/spatie/laravel-permission

*logs activity logs*
[spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog) - https://github.com/spatie/laravel-activitylog

## Need to implement
*module manager*
[caffeinated/modules](https://github.com/caffeinated/modules)


## installation

1- install composer dependency
~~~console
composer install
~~~

2- Create and configure the */.env* file using the lumen example
~~~console
cp .env.example .env
~~~

3- Generate application key
~~~console
php artisan key:generate
~~~

4- Configure the Timezone in a .env file
~~~env
APP_TIMEZONE=America/Sao_Paulo
~~~

5- configure the database data in .env

6- Run migration to create the database tables
~~~console
php artisan migrate
~~~

7- Run seed to insert the initial data into the tables (first user and access rules)
~~~console
php artisan db:seed
~~~

8- Install required encryption keys for Passport
~~~console
php artisan passport:install
~~~

9- include "CLIENT_SECRET" and "CLIENT_ID" generated by passaposrt in the .env file

10- generate API documentation for consultation in *public/docs/index.html*
~~~console
php artisan apidoc:generate
~~~

11- Run test
~~~console
vendor/bin/phpunit
~~~


---
## Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queuing, and caching.

### Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

### Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

### Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an email to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be addressed promptly.

### License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).