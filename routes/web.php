<?php

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

Route::get('/home', 'HomeController@index')->name('home');

// ----------------Admin routes----------------
// Admin index page
Route::get('admin.index', 'AdminController@index');
// Show all site users
Route::get('admin.users', 'AdminController@showUsers');
// Show selected site user
Route::get('admin.users/{id}', 'AdminController@show');
// Edit selected site user
Route::post('admin.users/{id}/edit', 'AdminController@update');
// Delete selected site user
Route::post('admin.users/{id}/delete', 'AdminController@destroy');