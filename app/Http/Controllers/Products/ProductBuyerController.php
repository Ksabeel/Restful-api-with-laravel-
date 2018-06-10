<?php

namespace App\Http\Controllers\Products;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductBuyerController extends ApiController
{
    public function index(Product $product)
    {
    	$buyers = $product->transactions()
    			->with('buyer')
    			->get()
    			->pluck('buyer')
    			->unique()
    			->values();

    	return $this->showAll($buyers);
    }
}
