<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Simple Laravel blog

## Install
1. **Clone** this project
2. Make:

        $ composer install
3. Configure database params in
`.env` file. (First change filename from `.env.example` to `.env`)

4. Migrate database from project folder:

        $ php artisan migrate

## Blog functional
- Register / Authorize
- Create / Edit / Delete posts
- Create / Edit / Delete comments for posts
- Search in blog posts