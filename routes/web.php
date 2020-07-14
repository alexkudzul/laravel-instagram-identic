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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');

// USUARIOS
Route::get('settings', 'UsersController@edit')->name('users.edit');
Route::put('update/{user}', 'UsersController@update')->name('users.update');
Route::get('profile/{user}', 'UsersController@show')->name('users.show');

// IMAGES
Route::get('upload-image', 'ImagesController@create')->name('images.create');
Route::post('store', 'ImagesController@store')->name('images.store');
Route::get('image/{id}', 'ImagesController@show')->name('images.show');

// COMMENTS
Route::post('comments', 'CommentsController@store')->name('comments.store');
Route::get('comments/edit/{id}', 'CommentsController@edit')->name('comments.edit');
Route::put('comments/update/{id}', 'CommentsController@update')->name('comments.update');
Route::delete('comments/{id}', 'CommentsController@destroy')->name('comments.destroy');
// Route::resource('comments', 'CommentsController');

// LIKES
Route::get('likes/favorites', 'LikesController@index')->name('likes.index');
Route::get('like/{id}', 'LikesController@like')->name('likes.like');
Route::get('unlike/{id}', 'LikesController@unlike')->name('likes.unlike');
