<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// buyers
Route::resource('buyers', 'Buyers\BuyersController')->only('index', 'show');
Route::resource('buyers.categories', 'Buyers\BuyerCategoryController')->only('index');
Route::resource('buyers.sellers', 'Buyers\BuyerSellerController')->only('index');
Route::resource('buyers.products', 'Buyers\BuyerProductController')->only('index');
Route::resource('buyers.transactions', 'Buyers\BuyerTransactionController')->only('index');

// Categories
Route::resource('categories', 'Categories\CategoriesController')->except('create', 'edit');

// Products
Route::resource('products', 'Products\ProductsController')->only('index', 'show');

// Sellers
Route::resource('sellers', 'Sellers\SellersController')->only('index', 'show');

// Transactions
Route::resource('transactions', 'Transactions\TransactionsController')->only('index', 'show');
Route::resource('transactions.categories', 'Transactions\TransactionCategoryController')->only('index');
Route::resource('transactions.sellers', 'Transactions\TransactionSellerController')->only('index');

// Users
Route::resource('users', 'Users\UsersController')->except('create', 'edit');