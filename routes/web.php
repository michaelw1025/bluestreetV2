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
// Admin home page
Route::get('admin.index', function(){
    return view('admin.index');
})->name('admin.index');

// Show all site users
Route::get('admin.users', 'UserController@index')->name('admin.all-users');
// Show selected site user
Route::get('admin.users/{id}', 'UserController@show')->name('admin.users');
// Edit selected site user
Route::post('admin.users/{id}/edit', 'UserController@update')->name('admin.edit-user');
// Delete selected site user
Route::post('admin.users/{id}/delete', 'UserController@destroy');

// Show all site roles
Route::get('admin.roles', 'RoleController@index')->name('admin.all-roles');
// Create new site role
Route::post('admin.roles', 'RoleController@store')->name('admin.create-role');
// Show selected site role
Route::get('admin.roles/{id}', 'RoleController@show')->name('admin.roles');
// Edit selected site role
Route::post('admin.roles/{id}/edit', 'RoleController@update')->name('admin.edit-role');
// Delete selected site role
Route::post('admin.roles/{id}/delete', 'RoleController@destroy');