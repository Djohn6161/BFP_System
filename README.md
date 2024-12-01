
## FIRMS BFP SYSTEM

This website will contain the literatures that are found inside the library of the Camarines Sur Polytechnic College, this is to help fellow researcher in their journey of searching related literatures for their own thesis or capstone.

#System Information

- This website uses mysql as the database
- download the XAMPP application if there is no xampp
```
[XAMPP Download](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe)
```
- It use a composer to install laravel
- Seach this and download the composer application if there is no Composer
```
[Composer istall](https://getcomposer.org/Composer-Setup.exe)
```
## How to host this website:

This website is created using laravel and will run by following these steps:

1. create a copy of env.example and then rename the copied file to ".env"

2. This command is to install composer:
```
composer install
```
3. Migrate the database of the website
```
php artisan migrate
```
4. Generate the data's that are in the laravel seeder
```
php artisan db:seed
```
5. Generate a key 
```
php artisan key:generate
```
6. Link the storage in the public and storage folder
```
php artisan storage:link
```
7. Now to run the server these following command should both run in 2 separate terminal:
```
php artisan serve
```
