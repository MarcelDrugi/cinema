<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Running the application

### To start the app, follow the steps below.

###### 1. Clone repo:

    git clone https://github.com/MarcelDrugi/cars

###### 2. Go to root directory:

    cd cinema

###### 4. Create database for the project on your local device.
You can use any SQL management system.
If you use MySQL, then:

    mysql -u [your_username] -p

###### 5. The project does not contain a vendor directory, you need to install dependencies.
Using composer, in root directory:

    composer install

###### 6. Create an .env file in root directory and copy the content of the .env.example file to it.

###### 7. In your new .env file insert the settings of the database created in step 4.
(Optionally, you can also change the other settings if you do not intend to use the default.)

###### 8. Generate an application key by artisan:

    php artisan key:generate

The key should be automatically inserted into the .env file as 'APP_KEY='. Check it out.

###### 9. Run migrations:

    php artisan migrate

###### 10. (optional) Enter the test data into the database:

    php artisan db:seed


###### 11. Check if the application works by starting the server:

    php artisan serve

If you haven't changed the settings, the application should start at: http://127.0.0.1:8000

Of course you can use another server (e.g. Apache 2).
