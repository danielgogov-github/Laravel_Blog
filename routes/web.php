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

Route::get('/', 'FrontendController@index');
Route::post('/', 'FrontendController@search');
Route::get('/show/category/{id}', 'FrontendController@show_category_posts');
Route::get('/show/{id}', 'FrontendController@show');
Route::post('/show/{id}', 'CommentsController@store');
Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/posts', 'PostsController');
    Route::put('/posts/publish/{id}', 'PostsController@publish');
    Route::resource('/comments', 'CommentsController');
    Route::get('/users', 'UsersController@index');
    Route::get('/users/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/users/register', 'Auth\RegisterController@register')->name('register');
    Route::delete('/users/{id}', 'UsersController@destroy');
});
