<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');

// USUARIOS
Route::get('/', 'HomeController@index')->name('home');
Route::get('configuration', 'UsersController@edit')->name('users.edit');
Route::put('update/{user}', 'UsersController@update')->name('users.update');

// IMAGES
Route::get('upload-image', 'ImagesController@create')->name('images.create');
Route::post('store', 'ImagesController@store')->name('images.store');
Route::get('image/{id}', 'ImagesController@show')->name('images.show');

