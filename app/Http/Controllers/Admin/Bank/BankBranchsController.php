<?php

namespace App\Http\Controllers\Admin\Bank;

use Session;
use App\Models\BankBranch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankBranchsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->expectsJson()) {
            return response()->json([
                'data' => BankBranch::orderBy('name')->get()
            ]);
        }
        return view('admin.bank.bank_branchs.index')
                ->with('bankBranchs', BankBranch::all());
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
            'name' => 'required|min:2|max:191',
        ]);

        if (BankBranch::create($attributes)) {
            Session::flash('success', 'Bank branch has been created successfully');
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankBranch  $bankbranch
     * @return \Illuminate\Http\Response
     */
    public function edit(BankBranch $bankbranch)
    {
        return view('admin.bank.bank_branchs.edit')
            ->with('bankbranch', $bankbranch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankBranch  $bankbranch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankBranch $bankbranch)
    {
        $attributes = $request->validate([
            'name' => 'required|min:2|max:191',
        ]);

        if ($bankbranch->update($attributes)) {
            Session::flash('success', 'Bank branch has been updated successfully');
        }

        return redirect()->route('admin.bankbranchs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankBranch  $bankbranch
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankBranch $bankbranch)
    {
        if ( $bankbranch->delete()) {
            Session::flash('success', 'Bank branch has been deleted successfully');
        }
        return back();
    }
}
