<?php

namespace App\Http\Controllers\Admin\Stock;

use Session;
use App\Models\Stock;
use App\Models\StockItem;
use App\Models\PacketSize;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::select('stocks.*','products.id as product_id','products.name as product_name')
                        ->join('products','products.id','=','stocks.product_id')
                        ->with(['category'])
                        ->orderBy('product_name')
                        ->get();
        return view('admin.stock.index')
                ->with('stocks', $stocks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stock.create')
                ->with('categories',ProductCategory::orderBy('name')->get())
                ->with('packet_sizes',PacketSize::orderBy('packet_size')->get());
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
            'category' => 'required',
            'product' => 'required|unique:stocks,product_id',
            'unit_sell_price' => 'required',
        ]);

        $request['category_id'] = $request->category;
        $request['product_id'] = $request->product;
        $request['quantity'] = $request->totalQuantity;

        $stock = Stock::create($request->all());

        $stock_items = [];

        foreach($request->packets as $packet){
            $stock_items[] = [
                'stock_id' => $stock->id,
                'packet_size_id' => $packet['packet_size']['id'],
                'packet_quantity' => $packet['packet_quantity'],
                'sub_quantity' => $packet['sub_quantity'],
                "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
            ];
        }

        StockItem::insert($stock_items);

        return response()->json([
            'data' => 'done',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        $s = $stock->load(['product','category']);
        return view('admin.stock.show')
                ->with('stock',$s)
                ->with('packet_sizes',PacketSize::orderBy('packet_size')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $stock->unit_sell_price = $request->price;
        if($stock->save()){
            return response()->json([
                'data' => 'done'
            ]);
        }
        return response()->json([
            'data' => 'Not done'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        if($stock->delete()){
            Session::flash('success','Stock product has been deleted Successfully');
        }
        return redirect()->back();
    }

    public function getStockItem(Stock $stock)
    {
        // return $stock->load(['stockItems','stockItems.packetSize']);
        return response()->json([
            'data' => $stock->load(['stockItems','stockItems.packetSize'])
        ]);
    }

    public function itemUpdate(Request $request, $item_id)
    {
        $item = StockItem::with('packetSize')->findOrfail($item_id);
        $request['packet_size_id'] = $request['packet_size']['id'];

        if($item->update($request->all())){

            $item->stock()->update([
                'quantity' => Stock::findOrfail($item->stock_id)->sumSubQuantity()
            ]);

            return response()->json([
                'data' => $item->load('packetSize')
            ]);
        }
        return response()->json([
            'data' => 'Not done'
        ]);
    }

    public function itemDelete(StockItem $item)
    {
        if($item->delete()){

            $item->stock()->update([
                'quantity' => Stock::findOrfail($item->stock_id)->sumSubQuantity()
            ]);

            return response()->json([
                'data' => 'done'
            ]);
        }

        return response()->json([
            'data' => 'Not done'
        ]);
    }

    public function itemCreate(Request $request)
    {
        $request['packet_size_id'] = $request['packet_size']['id'];

        if($item = StockItem::create($request->all())){

            $item->stock()->update([
                'quantity' => Stock::findOrfail($item->stock_id)->sumSubQuantity()
            ]);

            return response()->json([
                'data' => 'done'
            ]);
        }
        return response()->json([
            'data' => 'Not done'
        ]);
    }

    public function quantityDetails($product_id)
    {
        $SQL = 'SELECT p_items.product_id, products.name as product_name,p_items.sum_quantity as purchase_quantity,COALESCE(stocks.quantity,0) as stock_quantity,     (p_items.sum_quantity - COALESCE(stocks.quantity,0)) as quantity
                FROM (SELECT *,sum(quantity) as sum_quantity FROM purchase_items GROUP by product_id) as p_items
                LEFT JOIN stocks
                ON stocks.product_id = p_items.product_id
                LEFT JOIN products
                ON products.id = p_items.product_id
                WHERE products.status = 1
                AND p_items.product_id = '.$product_id.'
                GROUP BY product_id';

        return response()->json([
            'data' => collect(DB::select($SQL))
        ]);
    }
}
