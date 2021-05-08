<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\User\LoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('User')->group(function () {
    Route::get('/register', 'RegisterController@index')->name('user.signup.index');
    Route::post('/register', 'RegisterController@signup')->name('user.signup');
    Route::get('/verify/{token}', 'VerifyEmailController@verify')->name('user.email.verify');
    Route::get('/login', 'LoginController@index')->name('user.index');
    Route::post('/login', 'LoginController@login')->name('user.login');
    Route::get('/logout', 'LoginController@logout')->name('user.logout');
    Route::get('/delete', 'DeleteController@showDeleteInformation')->name('user.delete');
    Route::post('/delete', 'DeleteController@processDelete')->name('user.processDelete');
});
