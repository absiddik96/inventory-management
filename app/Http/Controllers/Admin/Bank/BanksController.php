<?php

namespace App\Http\Controllers\Admin\Bank;

use Session;
use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bank.banks.index')
            ->with('banks', Bank::all());
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
        if (Bank::create($attribute)) {
            Session::flash('success', 'Bank has been created successfully');
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('admin.bank.banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $attribute = $request->validate([
            'name' => 'required|min: 2|max: 191',
        ]);

        if ($bank->update($attribute)) {
            Session::flash('success', 'Bank has been updated successfully');
        }

        return redirect()->route('admin.banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        if ($bank->delete()) {
            Session::flash('success', 'Bank has been deleted successfully');
        }
        return back();
    }
}
