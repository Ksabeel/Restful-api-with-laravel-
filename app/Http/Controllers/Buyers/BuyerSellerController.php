<?php

namespace App\Http\Controllers\Buyers;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    public function index(Buyer $buyer)
    {
    	$products = $buyer->transactions()
    			->with('product.seller')
    			->get()
    			->pluck('product.seller')
    			->unique('id')
    			->values();

    	return $this->showAll($products);
    }
}
