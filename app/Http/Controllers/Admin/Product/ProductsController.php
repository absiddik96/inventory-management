<?php

namespace App\Http\Controllers\Admin\Product;

use Session;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.products.index')
                ->with('products', Product::orderBy('name')->with('category')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();
        if(!$categories->count()){
            Session::flash('info', 'Product Category not found');
            return back();
        }
        return view('admin.product.products.create')
                ->with('categories', $categories)
                ->with('product', new Product());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category' => 'required',
            'name' => 'required|min:2',
        ]);

        $request['product_category_id'] = $request->category;
        $request['status'] = $request->status??Product::DEACTIVE;
        if(Product::create($request->all())){
            Session::flash('success','Product has been created successfully');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.products.show')
                ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.products.edit')
                ->with('categories', ProductCategory::orderBy('name')->get())
                ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'category' => 'required',
            'name' => 'required|min:2',
        ]);

        $request['product_category_id'] = $request->category;
        $request['status'] = $request->status??Product::DEACTIVE;
        if($product->update($request->all())){
            Session::flash('success','Product has been updated successfully');
        }
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            Session::flash('success','Product has been deleted successfully');
        }
        return redirect()->route('admin.products.index');
    }
}
