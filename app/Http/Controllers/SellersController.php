<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;

class SellersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();

        return $this->showAll($sellers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        // $seller = Seller::has('products')->findOrFail($id);

        return $this->showOne($seller);
    }
}
