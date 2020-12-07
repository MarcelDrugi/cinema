<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About
Application under development. Early alpha version.
#### Live demo: [klasyczne-kino.infinityfreeapp.com](http://klasyczne-kino.infinityfreeapp.com/)

## Running the application locally

### To start the app, follow the steps below.

###### 1. Clone repo:

    git clone https://github.com/MarcelDrugi/cars

###### 2. Go to root directory:

    cd cinema

###### 4. Create database for the project on your local device.
You can use any SQL management system.
If you use MySQL, then:

    mysql -u [your_username] -p

###### 5. Go to AWS webstite.
<ul>
<li>Add a new IAM user to controll your bucket (create group for the user with built-in policy AmazonS3FullAccess),</li>
<li>create a s3-bucket,</li>
<li>set the policy of the bucket (set as public).</li>
</ul>

###### 6. The project does not contain a vendor directory, you need to install dependencies.
Using composer, in root directory:

    composer install

###### 7. Create an .env file in root directory and copy the content of the .env.example file to it.


###### 8. In your new .env file insert the settings of the database created in step 4 and bucket created in step 5.
(Optionally, you can also change the other settings if you do not intend to use the default.)

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=eu-west-1
    AWS_BUCKET=

###### 9. Generate an application key by artisan:

    php artisan key:generate

The key should be automatically inserted into the .env file as 'APP_KEY='. Check it out.

###### 10. Run migrations:

    php artisan migrate

###### 11. (optional) Enter the test data into the database:

    php artisan db:seed


###### 12. Check if the application works by starting the server:

    php artisan serve

If you haven't changed the settings, the application should start at: http://127.0.0.1:8000

Of course you can use another server (e.g. Apache 2).

### PayPal

###### If you want to use PayPal (on a sandbox), enter values of 3 constants for your sandbox account, in .env file:

    PAYPAL_MODE=sandbox
    PAYPAL_SANDBOX_CLIENT_ID=
    PAYPAL_SANDBOX_SECRET=

