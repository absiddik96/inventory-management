<?php

namespace App\Http\Controllers\Admin\Supplier;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierCreateRequest;
use App\Http\Requests\SupplierUpdateRequest;
use Illuminate\Support\Facades\Session;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()){
            return response()->json([
                'data' => Supplier::orderBy('name')->where('status',1)->get()
            ]);
        }

        return view('admin.suppliers.index')
                ->with('suppliers', Supplier::orderBy('name')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SupplierCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierCreateRequest $request)
    {
        if (Supplier::create($request->all())) {
            Session::flash('success', 'Supplier has been created.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show')
                ->with('supplier', $supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit')
                ->with('supplier', $supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SupplierUpdateRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        if ($supplier->update($request->all())) {
            Session::flash('success', 'Supplier has been updated.');
        }
        return redirect()->route('admin.suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->delete()) {
            Session::flash('success', 'Supplier has been deleted.');
        }
        return back();
    }

    public function changeStatus(Supplier $supplier)
    {
        if ($supplier->status) {
            $supplier->status = Supplier::DEACTIVE;
        }else{
            $supplier->status = Supplier::ACTIVE;
        }

        if($supplier->save()){
            Session::flash('success', 'Supplier status has been changed');
        }
        return back();
    }
}
