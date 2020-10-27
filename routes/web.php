<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('/', 'App\Http\Controllers\HomepageController');
Route::resource('/about', 'App\Http\Controllers\AboutController');
Route::resource('/api-description', 'App\Http\Controllers\ApiDescriptionController');
Route::resource('/pricing', 'App\Http\Controllers\PricingController');
Route::resource('/repertoire', 'App\Http\Controllers\RepertoireController');
Route::resource('/signin', 'App\Http\Controllers\SignInController');
Route::resource('/signup', 'App\Http\Controllers\SignUpController');
