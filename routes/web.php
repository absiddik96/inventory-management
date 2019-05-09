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
    // Dealers
    Route::get('/dealers', 'User\Dealer\DealersController@index')->name('user.dealers');
    // Stock
    Route::resource('/sell-products', 'User\SellProduct\SellProductsController', ['as' => 'user']);
    Route::get('/sell-product/{sellProduct}/dealer-show', 'User\SellProduct\SellProductsController@dealerShow')->name('sell-product.dealer.show');
    // PDF
    Route::get('/sell-product/{sellProduct}/dealer-pdf', 'User\SellProduct\SellProductsController@dealerPDF')->name('sell-product.dealer.pdf');
    Route::get('/sell-product/{sellProduct}/own-pdf', 'User\SellProduct\SellProductsController@PDFDownload')->name('sell-product.own.pdf');
    
    Route::get('/stock-products/{category}/category', 'User\Stock\StockProductsController@products')->name('user.stock.products');
    Route::get('/stock-packet-sizes/{stock}/stock', 'User\Stock\StockProductsController@packetSizes')->name('user.stock.packet-sizes');
    // Bank
    Route::get('/banks', 'Admin\Bank\BanksController@index')->name('user.banks');
    Route::get('/bank-branchs', 'Admin\Bank\BankBranchsController@index')->name('user.bank-branchs');
    Route::get('/bank-account/{bank_id}/branch/{branch_id}', 'Admin\Bank\BankAccountsController@bankAccountsByBankBranch')->name('user.bank-accounts.bank-branch');
    // Daily Records
    Route::resource('/daily-records', 'User\DailyRecord\DailyRecordsController', ['as' => 'user'])->only(['index', 'store']);
    Route::post('/daily-records/credit-data', 'User\DailyRecord\DailyRecordsController@creditData');
    Route::post('/daily-records/debit-data', 'User\DailyRecord\DailyRecordsController@debitData');
    Route::post('/daily-records/previous-amount', 'User\DailyRecord\DailyRecordsController@previousAmount');
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
    //Bulk Stock
    Route::resource('/bulk-stock', 'Admin\BulkStock\BulkStocksController', ['as' => 'admin']);
    // Category Product
    Route::get('/category/{category}/products', 'Admin\Category\CategoryProductController@products',['as' => 'admin'])->name('admin.category.product');
    // Account Bank
    Route::get('/bank/{bank_id}/accounts', 'Admin\Bank\AccountBankController@accounts',['as' => 'admin'])->name('admin.account.bank');
    
    // Account Bank
    Route::get('/category/{category}/purchase-item', 'Admin\BulkStock\PurchaseItemsController@products',['as' => 'admin'])->name('admin.category.purchase-items');
    //Stock
    Route::resource('/stocks', 'Admin\Stock\StocksController', ['as' => 'admin']);
    Route::post('/stock/{stock}/quantity-details', 'Admin\Stock\StocksController@quantityDetails')->name('admin.stock.quantity-details');
    Route::get('/stock-items/{stock}', 'Admin\Stock\StocksController@getStockItem')->name('admin.stock.items');
    Route::put('/stock-item/{item}', 'Admin\Stock\StocksController@itemUpdate')->name('admin.stock.item.update');
    Route::delete('/stock-item/{item}/delete', 'Admin\Stock\StocksController@itemDelete')->name('admin.stock.item.delete');
    Route::post('/stock-item', 'Admin\Stock\StocksController@itemCreate')->name('admin.stock.item.store');
});
