# Business Notes

This is a Laravel Test Project

# Requirements
  - Php 7.2^
  - Laravel 5.8
  - Redis
  - Mysql 5.7^

# Run

  - Download and copy to project directory
  -     composer self-update
  -     composer install
  -     php artisan key:generate
  - change database connection information
  - Find the CACHE_DRIVER parameter in the env file and change its value to "redis"
  -     php artisan migrate
  -     phpunit

