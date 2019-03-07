<?php

namespace App\Http\Controllers\Admin\Bank;

use Session;
use App\Models\Bank;
use App\Models\BankBranch;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bank.bank_accounts.index')
                ->with('bankAccounts', BankAccount::with(['bank', 'branch'])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.bank_accounts.create')
                ->with('banks', Bank::pluck('name', 'id')->all())
                ->with('branchs', BankBranch::pluck('name', 'id')->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'bank' => 'required',
            'branch' => 'required',
            'account_holder' => 'required|min:2|max:100',
            'account_number' => 'required|min:2|max:100',
            'details' => 'nullable|min:5',
        ]);

        $attributes['bank_id'] = $request->bank;
        $attributes['branch_id'] = $request->branch;
        $attributes['status'] = $request->status ?? 0;

        if (BankAccount::create($attributes)) {
            Session::flash('success', 'Bank account has been created successfully');
        }

        return redirect()->route('admin.bank-accounts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bank_account
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bank_account)
    {
        return view('admin.bank.bank_accounts.show')
                ->with('bankAccount', $bank_account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bank_account
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bank_account)
    {
        return view('admin.bank.bank_accounts.edit')
                ->with('bankAccount', $bank_account)
                ->with('banks', Bank::pluck('name', 'id')->all())
                ->with('branchs', BankBranch::pluck('name', 'id')->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bank_account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bank_account)
    {
        $attributes = $request->validate([
            'bank' => 'required',
            'branch' => 'required',
            'account_holder' => 'required|min:2|max:100',
            'account_number' => 'required|min:2|max:100',
            'details' => 'nullable|min:5',
        ]);

        $attributes['bank_id'] = $request->bank;
        $attributes['branch_id'] = $request->branch;
        $attributes['status'] = $request->status ?? 0;
            
        if ($bank_account->update($attributes)) {
            Session::flash('success', 'Bank account has been updated successfully');
        }

        return redirect()->route('admin.bank-accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bank_account
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bank_account)
    {
        if ($bank_account->delete()) {
            Session::flash('success', 'Bank account has been deleted successfully');
        }

        return redirect()->route('admin.bank-accounts.index');
    }

    public function active(BankAccount $bankAccount)
    {
        if ($bankAccount->update([
            'status' => !$bankAccount->status 
        ])) {
            Session::flash('success', 'Your change is successfully updated');
        }

        return back();
    }
}
