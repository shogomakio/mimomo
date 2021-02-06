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

Route::namespace('User')->group(function () {
    Route::get('/register', 'LoginController@show_signup_form')->name('signup');
    Route::post('/register', 'LoginController@process_signup');
    Route::get('/login', 'LoginController@show_login_form')->name('login');
    Route::post('/login', 'LoginController@process_login');
    Route::get('/logout', 'LoginController@logout')->name('logout');
});
