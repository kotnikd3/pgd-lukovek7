# PGD-Lukovek

## About the project
Website for PGD-Lukovek build with Laravel 7.x in Vuejs 2.x.  
Free to use.
![logo](Documentation/lukovek.png)

> 

## Build


``` bash
# install dependencies for back-end (php)
composer install

```bash
composer require laravel/ui
php artisan ui vue --auth

# migrate and seed
php artisan migrate --seed

# create a symbolic link from public/storage to storage/app/public
php artisan storage:link

# install dependencies for front-end (javascript)
npm install

# build for front-end
npm run dev

# build front-end with hot-reload
npm run watch-poll

# DB username/password: secret / secret123 
```