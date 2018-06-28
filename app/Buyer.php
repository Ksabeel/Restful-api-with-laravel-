<?php

namespace App;

use App\Transaction;
use App\Transformers\BuyerTransformer;

class Buyer extends User
{
	public $transformer = BuyerTransformer::class;

	public static function boot()
	{
		parent::boot();

		static::addGlobalScope( function($builder) {
			$builder->has('transactions');
		});	
	}

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }
}
