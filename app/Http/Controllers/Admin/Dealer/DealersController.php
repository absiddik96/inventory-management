<?php

namespace App\Http\Controllers\Admin\Dealer;

use App\Models\Dealer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateDealerRequest;
use App\Http\Requests\UpdateDealerRequest;

class DealersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dealers.index')
                ->with('dealers', Dealer::orderBy('name')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dealers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateDealerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDealerRequest $request)
    {
        if (Dealer::create($request->all())) {
            Session::flash('success', 'Dealer has been created');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function show(Dealer $dealer)
    {
        return view('admin.dealers.show')
                ->with('dealer', $dealer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function edit(Dealer $dealer)
    {
        return view('admin.dealers.edit')
                ->with('dealer', $dealer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDealerRequest  $request
     * @param  \App\Models\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDealerRequest $request, Dealer $dealer)
    {
        if ($dealer->update($request->all())) {
            Session::flash('success', 'Dealer has been updated');
        }
        return redirect()->route('admin.dealers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dealer $dealer)
    {
        if ($dealer->delete()) {
            Session::flash('success', 'Dealer has been deleted');
        }
        return back();
    }

    public function changeStatus(Dealer $dealer)
    {
        if ($dealer->status) {
            $dealer->status = Dealer::DEACTIVE;
        } else{
            $dealer->status = Dealer::ACTIVE;
        }

        if ($dealer->save()) {
            Session::flash('info', 'Dealer status has been changed.');
        }
        return back();
    }
}