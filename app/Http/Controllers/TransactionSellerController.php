<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionSellerController extends ApiController
{
    public function index(Transaction $transaction)
    {
    	$seller = $transaction->product->seller;

    	return $this->showOne($seller);
    }
}
