<?php

namespace App\Http\Controllers\User\SellProduct;

use PDF;
use App\Models\Bank;
use App\Models\Stock;
use App\Models\Dealer;
use App\Models\BankBranch;
use App\Models\SellProduct;
use Illuminate\Http\Request;
use App\Models\BankTransaction;
use App\Models\SellProductItem;
use App\Http\Controllers\Controller;
use App\Traits\Dealer as AppDealer;
use Illuminate\Support\Facades\Session;

class SellProductsController extends Controller
{
    use AppDealer;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.sell_product.index')
            ->with('sell_details', SellProduct::orderBy('created_at','desc')->with('dealer')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.sell_product.create')
                ->with('categories', Stock::with('category')->get()->pluck('category')->unique('id')->values());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'dealer' => 'required',
            'invoice_no' => 'required',
            'date' => 'required',
            'grand_total' => 'required',
            'amount_pay' => 'required',
            'amount_due' => 'required',
            'previous_due' => 'required',
            'total_due' => 'required',
            'payment_type' => 'required',
        ]);

        if($request->payment_type==1 && !$request->is_verified){
            // Transaction 
            $dealer = Dealer::findOrfail($request->dealer['id']);
            $transaction = $dealer->transactions()->create([
                'bank_id'          => $request->bank,
                'branch_id'        => $request->branch,
                'bank_account_id'  => $request->account_number,
                'transaction_type' => BankTransaction::TRANSACTION_TYPE_CREDIT,
                'amount'           => $request->amount_pay,
                'transaction_date' => $request->date,
                'supervisor_id'    => auth()->user()->id,
            ]);

            $request['transaction_id'] = $transaction->id;
        }

        $request['dealer_id'] = $request->dealer['id'];
        $request['is_verified'] = $request->is_verified ? SellProduct::VERIFIED : SellProduct::UNVERIFIED;
        
        $sellProduct = SellProduct::create($request->all());
        
        $sell_items = [];

        foreach($request->sell_items as $sell_item){
            $sell_items[] = [
                'stock_id' => $sell_item['stock_id'],
                'sell_product_id' => $sellProduct->id,
                'category_id' => $sell_item['category_id'],
                'product_id' => $sell_item['product_id'],
                'packet_size_id' => $sell_item['packet_size']['packet_size_id'],
                'packet_quantity' => $sell_item['quantity'],
                'sub_quantity' => $sell_item['total_quantity'],
                'unit_price' => $sell_item['unit_price'],
                'total' => $sell_item['total'],
                
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
            ];
        }

        SellProductItem::insert($sell_items);
        
        return response()->json([
            'data' => 'done'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellProduct  $sellProduct
     * @return \Illuminate\Http\Response
     */
    public function show(SellProduct $sellProduct){
        return view('user.sell_product.show')
            ->with('sell_product', $sellProduct->load(['sellProductItems','sellProductItems.packetSize','transaction','transaction.bankAccount']))
            ->with('dealer_previous_due',$this->dealerPreviousDue($sellProduct->dealer_id)[0]);
    }

    public function PDFDownload(SellProduct $sellProduct){
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 180);

        $sell_product = $sellProduct->load(['sellProductItems','sellProductItems.packetSize','transaction','transaction.bankAccount']);
        $dealer_previous_due = $this->dealerPreviousDue($sellProduct->dealer_id)[0];

        $pdf = PDF::loadView('PDF.sell_product.own',['sell_product'=>$sell_product,'dealer_previous_due'=>$dealer_previous_due]);
        $pdf->setPaper('A4', 'portal');
        return $pdf->download($sell_product->dealer->name.'-'.strtoupper($sell_product->invoice_no).'.pdf');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SellProduct  $sellProduct
     * @return \Illuminate\Http\Response
     */
    public function dealerShow(SellProduct $sellProduct){
        return view('user.sell_product.dealer_show')
            ->with('sell_product', $sellProduct->load(['sellProductItems','sellProductItems.packetSize','transaction','transaction.bankAccount']))
            ->with('dealer_previous_due',$this->dealerPreviousDue($sellProduct->dealer_id)[0]);
    }

    public function dealerPDF(SellProduct $sellProduct){
        // return view('PDF.sell_product.dealer')
        //     ->with('sell_product', $sellProduct->load(['sellProductItems','sellProductItems.packetSize','transaction','transaction.bankAccount']))
        //     ->with('dealer_previous_due',$this->dealerPreviousDue($sellProduct->dealer_id)[0]);

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 180);

        $sell_product = $sellProduct->load(['sellProductItems','sellProductItems.packetSize','transaction','transaction.bankAccount']);
        $dealer_previous_due = $this->dealerPreviousDue($sellProduct->dealer_id)[0];

        $pdf = PDF::loadView('PDF.sell_product.dealer',['sell_product'=>$sell_product,'dealer_previous_due'=>$dealer_previous_due]);
        $pdf->setPaper('A4', 'portal');
        return $pdf->download($sell_product->dealer->name.'-'.strtoupper($sell_product->invoice_no).'.pdf');        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellProduct  $sellProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(SellProduct $sellProduct)
    {
        return view('user.sell_product.edit')
                ->with('banks', Bank::orderBy('name')->get())
                ->with('branchs', BankBranch::orderBy('name')->get())
                ->with('sell_product', $sellProduct->load(['sellProductItems','sellProductItems.packetSize','transaction','transaction.bankAccount']))
                ->with('categories', Stock::with('category')->get()->pluck('category')->unique('id')->values());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SellProduct  $sellProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellProduct $sellProduct)
    {
        $this->validate($request,[
            'dealer' => 'required',
            'invoice_no' => 'required',
            'date' => 'required',
            'grand_total' => 'required',
            'amount_pay' => 'required',
            'amount_due' => 'required',
            'previous_due' => 'required',
            'total_due' => 'required',
            'payment_type' => 'required',
        ]);

        if($sellProduct->transaction_id){
            $sellProduct->transaction()->delete();
            $request['transaction_id'] = null;
        }

        if($request->payment_type==1 && !$request->is_verified){
            // Transaction 
            $dealer = Dealer::findOrfail($request->dealer['id']);
            $transaction = $dealer->transactions()->create([
                'bank_id'          => $request->bank,
                'branch_id'        => $request->branch,
                'bank_account_id'  => $request->account_number,
                'transaction_type' => BankTransaction::TRANSACTION_TYPE_CREDIT,
                'amount'           => $request->amount_pay,
                'transaction_date' => $request->date,
                'supervisor_id'    => auth()->user()->id,
            ]);

            $request['transaction_id'] = $transaction->id;
        }

        $request['dealer_id'] = $request->dealer['id'];
        $request['is_verified'] = $request->is_verified ? SellProduct::VERIFIED : SellProduct::UNVERIFIED;
        
        $sellProduct->update($request->all());
        $sellProduct->sellProductItems()->delete();
        $sell_items = [];

        foreach($request->sell_items as $sell_item){
            $sell_items[] = [
                'stock_id' => $sell_item['stock_id'],
                'sell_product_id' => $sellProduct->id,
                'category_id' => $sell_item['category_id'],
                'product_id' => $sell_item['product_id'],
                'packet_size_id' => $sell_item['packet_size']['packet_size_id'],
                'packet_quantity' => $sell_item['quantity'],
                'sub_quantity' => $sell_item['total_quantity'],
                'unit_price' => $sell_item['unit_price'],
                'total' => $sell_item['total'],
                
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
            ];
        }

        SellProductItem::insert($sell_items);
        
        return response()->json([
            'data' => 'done'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellProduct  $sellProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellProduct $sellProduct)
    {
        if($sellProduct->transaction_id){
            $sellProduct->transaction()->delete();
        }
        $sellProduct->sellProductItems()->delete();

        if($sellProduct->delete()){
            Session::flash('success','Sell Product has been deleted successfully');
        }

        return redirect()->back();
    }
}
