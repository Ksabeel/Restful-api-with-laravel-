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
Route::resource('buyers', 'BuyersController')->only('index', 'show');
Route::resource('buyers.categories', 'BuyerCategoryController')->only('index');
Route::resource('buyers.sellers', 'BuyerSellerController')->only('index');
Route::resource('buyers.products', 'BuyerProductController')->only('index');
Route::resource('buyers.transactions', 'BuyerTransactionController')->only('index');

// Categories
Route::resource('categories', 'CategoriesController')->except('create', 'edit');

// Products
Route::resource('products', 'ProductsController')->only('index', 'show');

// Sellers
Route::resource('sellers', 'SellersController')->only('index', 'show');

// Transactions
Route::resource('transactions', 'TransactionsController')->only('index', 'show');
Route::resource('transactions.categories', 'TransactionCategoryController')->only('index');
Route::resource('transactions.sellers', 'TransactionSellerController')->only('index');

// Users
Route::resource('users', 'UsersController')->except('create', 'edit');