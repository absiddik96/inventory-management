<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    public function products(ProductCategory $category)
    {
        return response()->json([
            'data' => $category->activeProducts
        ]);
    }
}
