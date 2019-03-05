<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.category.index')
            ->with('category', new ProductCategory())
            ->with('categories', ProductCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = $request->validate([
            'name' => 'required|min: 2|max: 191',
        ]);

        if (ProductCategory::create($attribute)) {
            Session::flash('success', 'Product Category has been created successfully');
        }
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $category)
    {
        return view('product.category.edit')
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $category)
    {
        $attribute = $request->validate([
            'name' => 'required|min: 2|max: 191',
        ]);
        if ($category->update($attribute)) {
            Session::flash('success', 'Product Category has been updated successfully');
        }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {
        if ($category->delete()) {
            Session::flash('success', 'Product Category has been deleted successfully');
        }
        return back();
    }
}
