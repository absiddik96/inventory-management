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
});

Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function () {
    // Banks
    Route::resource('/banks', 'Admin\Bank\BanksController', ['as' => 'admin'])->except(['create', 'show']);
    // Bank branchs
    Route::resource('/bankbranchs', 'Admin\Bank\BankBranchsController', ['as' => 'admin'])->except(['create', 'show']);
    // Bank accounts
    Route::resource('/bank-accounts', 'Admin\Bank\BankAccountsController', ['as' => 'admin']);
    Route::get('/bank-account/{bankAccount}/activation', 'Admin\Bank\BankAccountsController@active', ['as' => 'admin'])->name('admin.bank-accounts.active');
    Route::get('/bank-account/{bank_id}/branch/{branch_id}', 'Admin\Bank\BankAccountsController@bankAccountsByBankBranch', ['as' => 'admin'])->name('admin.bank-accounts.bank_branch');
    // Users
    Route::resource('/users', 'Admin\UsersController', ['as' => 'admin'])->except(['show']);
    Route::get('/user/{user}/status', 'Admin\UsersController@status')->name('admin.users.status');
    Route::get('/user/{user}/type', 'Admin\UsersController@type')->name('admin.users.type');
    // Packet sizes
    Route::resource('/packet-sizes', 'Admin\PacketSizesController', ['as' => 'admin'])->except(['create', 'show']);
    // Bank transaction
    Route::resource('/bank-transactions', 'Admin\Bank\BankTransactionsController', ['as' => 'admin'])->only(['index','store']);
    // Suppliers
    Route::resource('/suppliers', 'Admin\Supplier\SuppliersController', ['as' => 'admin']);
    Route::get('/supplier/{supplier}/status', 'Admin\Supplier\SuppliersController@changeStatus')->name('admin.suppliers.change_status');
    // Product Category
    Route::resource('product/categories', 'Admin\Product\ProductCategoriesController',['as' => 'admin'])->except(['create', 'show']);
    Route::resource('products', 'Admin\Product\ProductsController',['as' => 'admin']);
    //Dealer
    Route::resource('/dealers', 'Admin\Dealer\DealersController', ['as' => 'admin']);
    Route::get('/dealer/{dealer}/status', 'Admin\Dealer\DealersController@changeStatus')->name('admin.dealers.change_status');
});
