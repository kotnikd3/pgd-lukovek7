# PGD-Lukovek
Website for PGD-Lukovek build with Laravel 7.x in Vuejs.
> 

## Build Setup


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
```
