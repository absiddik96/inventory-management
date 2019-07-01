<?php

namespace App\Http\Controllers\Admin\Dealer;

use App\Models\Dealer;
use App\Traits\Dealer as AppDealer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateDealerRequest;
use App\Http\Requests\UpdateDealerRequest;
use App\Models\SellProduct;

class DealersController extends Controller
{

    use AppDealer;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->expectsJson()){
            return response()->json([
                'data' => Dealer::orderBy('name')->where('status',1)->get()
            ]);
        }

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
                ->with('dealer', $dealer)
                ->with('dealer_due', $this->dealerPreviousDue($dealer->id)[0])
                ->with('purchase_history', SellProduct::where('dealer_id',$dealer->id)->orderBy('created_at','desc')->get());
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
