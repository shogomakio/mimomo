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
    Route::get('/register', 'RegisterController@showSignupForm')->name('user.signup');
    Route::post('/register', 'RegisterController@processSignup');
    Route::get('/verify/{token}', 'VerifyEmailController@verifyEmail')->name('user.verifyEmail');
    Route::get('/login', 'LoginController@showLoginForm')->name('user.login');
    Route::post('/login', 'LoginController@processLogin');
    Route::get('/logout', 'LoginController@logout')->name('user.logout');
});
