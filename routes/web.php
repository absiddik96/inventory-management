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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    // Product Category
    Route::resource('product/categories', 'ProductCategoriesController')->except(['create', 'show']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function () {
    // Banks
    Route::resource('/banks', 'Admin\Bank\BanksController', ['as' => 'admin'])->except(['create', 'show']);
    // Bank branchs
    Route::resource('/bankbranchs', 'Admin\Bank\BankBranchsController', ['as' => 'admin'])->except(['create', 'show']);
    // Users
    Route::resource('/users', 'Admin\UsersController', ['as' => 'admin'])->except(['show']);
    Route::get('/user/{user}/status', 'Admin\UsersController@status')->name('admin.users.status');
    Route::get('/user/{user}/type', 'Admin\UsersController@type')->name('admin.users.type');
});
