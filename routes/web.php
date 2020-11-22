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

Route::resource('/discount', 'App\Http\Controllers\DiscountController');
Route::delete('/discount/delete', 'App\Http\Controllers\DiscountController@destroy')->name('discount.destroy');

Route::resource('/information', 'App\Http\Controllers\InformationController');
Route::put('/information', 'App\Http\Controllers\InformationController@update')->name('information.update');

Route::resource('/modify-pricing', 'App\Http\Controllers\ModifyPricingController');
Route::put('/modify-pricing', 'App\Http\Controllers\ModifyPricingController@update')->name('modify-pricing.update');

Route::get('/movie/{action?}', 'App\Http\Controllers\MovieController@index')->name('movie.index');
Route::post('/movie', 'App\Http\Controllers\MovieController@store')->name('movie.store');
Route::put('/movie', 'App\Http\Controllers\MovieController@update')->name('movie.update');
Route::put('/movie/delete', 'App\Http\Controllers\MovieController@destroy')->name('movie.destroy');

Route::get('/order/{id}', 'App\Http\Controllers\OrderController@index')->name('order.index');
Route::post('/order', 'App\Http\Controllers\OrderController@store')->name('order.store');

Route::resource('/summary', 'App\Http\Controllers\OrderSummaryController');

Route::resource('/pricing', 'App\Http\Controllers\PricingController');

Route::get('/profile/info/{action?}', 'App\Http\Controllers\ProfileController@index')->name('profile.index');
Route::post('/profile', 'App\Http\Controllers\ProfileController@store')->name('profile.store');
Route::put('/profile/{profile}', 'App\Http\Controllers\ProfileController@update')->name('profile.update');

Route::resource('/repertoire', 'App\Http\Controllers\RepertoireController');

Route::get('/screening', 'App\Http\Controllers\ScreeningController@index')->name('screening.index');
Route::post('/screening', 'App\Http\Controllers\ScreeningController@store')->name('screening.store');
Route::put('/screening', 'App\Http\Controllers\ScreeningController@update')->name('screening.update');
Route::put('/screening/delete', 'App\Http\Controllers\ScreeningController@destroy')->name('screening.destroy');

Route::get('/noperm/{role}','App\Http\Controllers\NoPermissionController@index')->name('no-perm');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', function()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');

/*
 * PayPal
 */
Route::post('reservation', 'App\Http\Controllers\ReservationController@store')->name('create-reservation');
