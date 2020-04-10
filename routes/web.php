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

Route::get('/', 'PagesController@index');

Route::resource('/resumes', 'ResumesController');

Route::resource('/tags', 'TagsController');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('index');

Route::get('/user/{id}', 'UsersController@show');
Route::get('/user/{id}/edit', 'UsersController@edit');
Route::put('/user/{id}', 'UsersController@update');

// Route::get('/cache', 'CacheController@index');
