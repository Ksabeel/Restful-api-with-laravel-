<?php

namespace App;

use App\Product;
use App\Transformers\SellerTransformer;

class Seller extends User
{
	public $transformer = SellerTransformer::class;

	public static function boot()
	{
		parent::boot();

		static::addGlobalScope( function($builder) {
			$builder->has('products');
		});	
	}

    public function products()
    {
    	return $this->hasMany(Product::class);
    }
}
