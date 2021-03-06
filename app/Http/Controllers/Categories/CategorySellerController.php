<?php

namespace App\Http\Controllers\Categories;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategorySellerController extends ApiController
{
    public function index(Category $category)
    {
    	$sellers = $category->products()
    			->with('seller')
    			->get()
    			->pluck('seller')
    			->unique('id')
    			->values();

    	return $this->showAll($sellers);
    }
}
