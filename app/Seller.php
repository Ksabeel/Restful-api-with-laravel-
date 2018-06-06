<?php

namespace App;

use App\Product;

class Seller extends User
{
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
