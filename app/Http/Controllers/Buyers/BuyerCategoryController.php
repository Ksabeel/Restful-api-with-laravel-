<?php

namespace App\Http\Controllers\Buyers;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

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
