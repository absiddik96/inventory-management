<?php

namespace App\Http\Controllers\Admin\Bank;

use Session;
use App\User;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Models\BankTransaction;
use App\Http\Controllers\Controller;
use Lcobucci\JWT\Claim\LesserOrEqualsTo;
use App\Rules\LessThanOrEqual;

class BankTransactionsController extends Controller
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
                'data' => BankTransaction::latest()->with(['bankAccount','bankAccount.bank','bankAccount.branch'])->get()
            ]);
        }
        return view('admin.bank.bank_transactions.index')
            ->with('transactions', BankTransaction::latest()->with(['bankAccount','bankAccount.bank','bankAccount.branch'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank_account = null;
        if($request->bank_account){
            $bank_account = BankAccount::findOrfail($request->bank_account);
        }
        
        $request->validate([
            'bank'             => 'required',
            'branch'           => 'required',
            'bank_account'     => 'required',
            'transaction_type' => 'required',
            'amount'           => [
                'required', 
                (($request->transaction_type == 0 && $bank_account)?new LessThanOrEqual($bank_account->totalAmount()):'')
            ],
            'transaction_date' => 'required',
        ]);

        $bank_transaction = new BankTransaction();

        $bank_transaction->bank_id          = $request->bank;
        $bank_transaction->branch_id        = $request->branch;
        $bank_transaction->bank_account_id  = $request->bank_account;
        $bank_transaction->transaction_type = $request->transaction_type;
        $bank_transaction->amount           = $request->amount;
        $bank_transaction->transaction_date = $request->transaction_date;
        $bank_transaction->supervisor_id    = auth()->user()->id;

        if(!$request->confirm){
            return '';
        }

        if($bank_transaction->save()){
            return response()->json([
                'message' => "Transaction has been completed successfully",
            ]);
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankTransaction  $bank_transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankTransaction $bank_transaction)
    {
        $bank_account = null;
        if($request->bank_account){
            $bank_account = BankAccount::findOrfail($request->bank_account);
        }
        
        $request->validate([
            'bank'             => 'required',
            'branch'           => 'required',
            'bank_account'     => 'required',
            'transaction_type' => 'required',
            'amount'           => [
                'required', 
                (($request->transaction_type == 0 && $bank_account)?new LessThanOrEqual($bank_account->totalAmount()):'')
            ],
            'transaction_date' => 'required',
        ]);

        $bank_transaction->bank_id          = $request->bank;
        $bank_transaction->branch_id        = $request->branch;
        $bank_transaction->bank_account_id  = $request->bank_account;
        $bank_transaction->transaction_type = $request->transaction_type;
        $bank_transaction->amount           = $request->amount;
        $bank_transaction->transaction_date = $request->transaction_date;
        $bank_transaction->supervisor_id    = auth()->user()->id;

        if($bank_transaction->save()){
            return response()->json([
                'message' => "Transaction has been updated  successfully",
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankTransaction  $bank_transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankTransaction $bank_transaction)
    {
        if($bank_transaction->delete()){
            return response()->json([
                'message' => "Transaction has been deleted successfully",
            ]);
        };
    }
}
