<?php

namespace App;

use App\Transaction;

class Buyer extends User
{
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
