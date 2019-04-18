<?php

namespace App\Http\Controllers\Admin\BulkStock;

use App\Models\Supplier;
use App\Models\BulkStock;
use Illuminate\Http\Request;
use App\Models\BankTransaction;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankBranch;
use Illuminate\Support\Facades\Session;

class BulkStocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return BulkStock::latest()->with('supplier')->get();
        return view('admin.bulk_stock.index')
                ->with('bulk_stocks', BulkStock::latest()->with('supplier')->get());
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
        return view('admin.bulk_stock.show')
                ->with('bulk_stock',$bulkStock->load(['purchaseItems','supplier','transaction','transaction.bankAccount']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BulkStock  $bulkStock
     * @return \Illuminate\Http\Response
     */
    public function edit(BulkStock $bulkStock)
    {
        return view('admin.bulk_stock.edit')
                ->with('suppliers', Supplier::orderBy('name')->where('status',Supplier::ACTIVE)->get())
                ->with('categories', ProductCategory::orderBy('name')->get())
                ->with('banks', Bank::orderBy('name')->get())
                ->with('branchs', BankBranch::orderBy('name')->get())
                ->with('bulk_stock',$bulkStock->load(['purchaseItems','supplier','transaction','transaction.bankAccount']));
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
        $request->validate([
            'lc_number' => 'required|unique:bulk_stocks,lc_number,'.$bulkStock->id,
            'supplier' => 'required',
            'date' => 'required',
            'purchase_items' => 'required',
            'grand_total' => 'required',
            'amount_pay' => 'required',
            'amount_due' => 'required',
            'payment_type' => 'required',
        ]);

        if($bulkStock->transaction_id){
            BankTransaction::findOrfail($bulkStock->transaction_id)->delete();
            $request['transaction_id'] = null;
        }

        if(!$request->is_verified){
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
        
        $bulkStock->update($request->all());
        $bulkStock->purchaseItems()->delete();
        $bulkStock->purchaseItems()->createMany($request->purchase_items);

        Session::flash('success', 'Bulk stock has been updated successfully');
        
        return response()->json([
            'data' => route('admin.bulk-stock.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BulkStock  $bulkStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(BulkStock $bulkStock)
    {
        if($bulkStock->transaction_id){
            BankTransaction::findOrfail($bulkStock->transaction_id)->delete();
        }

        if($bulkStock->delete()){
            Session::flash('success', 'Bulk stock has been updated successfully');
        }

        return redirect()->back();
    }
}
