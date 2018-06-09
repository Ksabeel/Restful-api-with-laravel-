<?php

namespace App\Http\Controllers\Sellers;

use App\User;
use App\Seller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends ApiController
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Seller $seller)
	{
		$products = $seller->products;

		return $this->showAll($products);
	}

	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $seller)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'sometimes|image',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'image' => '1.jpg',
            'status' => 0,
            'seller_id' => $seller->id
        ]);

        return $this->showOne($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller, Product $product)
    {
        $request->validate([
            'quantity' => 'integer|min:1',
            'image' => 'image'
        ]);

        $this->checkSeller($seller, $product);

        $product->fill($request->only([
            'name', 'description', 'quantity'
        ]));

        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return $this->errorResponse('An active product must have at least one category', 409);
            }
        }

        if ($product->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $product->save();

        return $this->showOne($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);

        $product->delete();

        return $this->showOne($product);
    }

    protected function checkSeller(Seller $seller, Product $product)
    {
        if ($seller->id !== $product->seller_id) {
            throw new HttpException(422, "The specified seller is not the actual seller of this product");
        }
    }
}
