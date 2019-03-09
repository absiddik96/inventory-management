<?php

namespace App\Http\Controllers\Admin\Bank;

use App\User;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Models\BankTransaction;
use App\Http\Controllers\Controller;

class BankTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bank.bank_transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.bank_transactions.create')
                ->with('bank_account', BankAccount::pluck('account_number', 'id')->all())
                ->with('supervisor', User::pluck('name', 'id')->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bank_transaction
     * @return \Illuminate\Http\Response
     */
    public function show(BankTransaction $bank_transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bank_transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BankTransaction $bank_transaction)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankTransaction  $bank_transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankTransaction $bank_transaction)
    {
        //
    }
}
