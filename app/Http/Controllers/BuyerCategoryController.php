<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;

class BuyerCategoryController extends ApiController
{
    public function index(Buyer $buyer)
    {
    	$products = $buyer->transactions()
    			->with('product.categories')
    			->get()
    			->pluck('product.categories')
    			->collapse()
    			->unique('id')
    			->values();

    	return $this->showAll($products);
    }
}
