<?php

namespace App\Http\Controllers\Products;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductTransactionController extends ApiController
{
    public function index(Product $product)
    {
    	$transactions = $product->transactions;

    	return $this->showAll($transactions);
    }
}
