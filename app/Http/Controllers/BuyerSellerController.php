<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;

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
