<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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


Route::resource('/', 'App\Http\Controllers\HomepageController',
    ['names' => [
        'index' => 'homepage.index',
        'store' => 'homepage.store',
    ]]     
);
Route::get('/homepage/{action?}', 'App\Http\Controllers\HomepageController@index')->name('homepage.index');
Route::resource('/about', 'App\Http\Controllers\AboutController');
Route::resource('/admin', 'App\Http\Controllers\AdminPanelController',
    ['names' => [
        'index' => 'adminpanel.index',
        'store' => 'adminpanel.store',
    ]]
);
Route::resource('/api-description', 'App\Http\Controllers\ApiDescriptionController');
Route::get('/order/{id?}', 'App\Http\Controllers\OrderController@index')->name('order.index');
Route::post('/order', 'App\Http\Controllers\OrderController@store')->name('order.store');
Route::resource('/api-description', 'App\Http\Controllers\OrderSummaryController',
    ['names' => [
        'index' => 'summary.index',
        'store' => 'summary.store',
    ]]
);
Route::resource('/pricing', 'App\Http\Controllers\PricingController');
Route::get('/profile/info/{action?}', 'App\Http\Controllers\ProfileController@index')->name('profile.index');
Route::put('/profile/{profile}', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
Route::resource('/repertoire', 'App\Http\Controllers\RepertoireController');
Route::resource('/signin', 'App\Http\Controllers\SignInController');
Route::resource('/signup', 'App\Http\Controllers\SignUpController');
Route::get('/noperm/{role}','App\Http\Controllers\NoPermissionController@index')->name('no-perm');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', function()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');
