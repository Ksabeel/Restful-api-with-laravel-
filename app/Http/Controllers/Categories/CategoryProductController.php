<?php

namespace App\Http\Controllers\Categories;

use App\Category;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategoryProductController extends ApiController
{
    public function index(Category $category)
    {
    	$products = $category->products;

    	return $this->showAll($products);
    }
}
