<?php

namespace App\Http\Controllers\Admin\BulkStock;

use App\Models\Supplier;
use App\Models\BulkStock;
use Illuminate\Http\Request;
use App\Models\BankTransaction;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class BulkStocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bulk_stock.create')
                ->with('suppliers', Supplier::orderBy('name')->where('status',Supplier::ACTIVE)->get())
                ->with('categories', ProductCategory::orderBy('name')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lc_number' => 'required|unique:bulk_stocks,lc_number',
            'supplier' => 'required',
            'date' => 'required',
            'purchase_items' => 'required',
            'grand_total' => 'required',
            'amount_pay' => 'required',
            'amount_due' => 'required',
            'payment_type' => 'required',
        ]);
        if(!$request->is_verified){
            // Transaction 
            $supplier = Supplier::findOrfail($request->supplier);
            $transaction = $supplier->transactions()->create([
                'bank_id'          => $request->bank,
                'branch_id'        => $request->branch,
                'bank_account_id'  => $request->account_number,
                'transaction_type' => BankTransaction::TRANSACTION_TYPE_DEBIT,
                'amount'           => $request->amount_pay,
                'transaction_date' => $request->date,
                'note'             => $request->note,
                'supervisor_id'    => auth()->user()->id,
            ]);

            $request['transaction_id'] = $transaction->id;
        }

        $request['supplier_id'] = $request->supplier;
        $request['is_verified'] = $request->is_verified ? BulkStock::VERIFIED : BulkStock::UNVERIFIED;
        
        $bulkStock = BulkStock::create($request->all());
        $bulkStock->purchaseItems()->createMany($request->purchase_items);
        
        return response()->json([
            'data' => 'data add successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BulkStock  $bulkStock
     * @return \Illuminate\Http\Response
     */
    public function show(BulkStock $bulkStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BulkStock  $bulkStock
     * @return \Illuminate\Http\Response
     */
    public function edit(BulkStock $bulkStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BulkStock  $bulkStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BulkStock $bulkStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BulkStock  $bulkStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(BulkStock $bulkStock)
    {
        //
    }
}
