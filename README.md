cartitas

installation
composer create-project laravel/laravel cards (copy installation in "cards" folder) 
composer require laravel/breeze 
php artisan breeze:install vue 
npm install
npm run dev

create database
create database cards; create user cards@localhost identified by 'cards'; grant all privileges on cards.* to cards@localhost; flush privileges;

set .env
(set data connection) php artisan migrate:fresh --seed php artisan storage:link

