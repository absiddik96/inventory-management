<?php

namespace App\Http\Controllers\User\Stock;

use App\Models\Stock;
use App\Models\StockItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StockProductsController extends Controller
{
    public function products($category_id)
    {
        return response()->json([
            'data' => Stock::select('stocks.*','products.name as product_name')
                                ->join('products','products.id','=','stocks.product_id')
                                ->where('products.status',1)
                                ->get()
        ]);
    }

    public function packetSizes($stock_id)
    {
        $SQL = 'SELECT table_stocks_item.stock_id,table_stocks_item.product_id, table_stocks_item.packet_size_id, table_stocks_item.packet_size, (SUM(table_stocks_item.packet_quantity) - COALESCE(table_sell_packet_quantity.sell_packet_quantity,0)) as packet_quantity

                FROM (SELECT stock_items.stock_id,stocks.product_id, stock_items.packet_size_id, packet_sizes.packet_size, SUM(stock_items.packet_quantity) as packet_quantity
                FROM `stock_items` 
                LEFT JOIN packet_sizes
                ON packet_sizes.id = stock_items.packet_size_id
                JOIN stocks
                ON stocks.id = stock_items.stock_id
                WHERE stock_items.stock_id = '.$stock_id.'
                GROUP BY stock_items.packet_size_id, stock_items.stock_id) as table_stocks_item
                
                
                LEFT JOIN (SELECT product_id, packet_size_id, SUM(packet_quantity) as sell_packet_quantity FROM `sell_product_items` GROUP BY product_id, packet_size_id) as table_sell_packet_quantity
                ON table_sell_packet_quantity.packet_size_id = table_stocks_item.packet_size_id
                AND table_sell_packet_quantity.product_id = table_stocks_item.product_id
                
                GROUP BY table_stocks_item.packet_size_id, table_stocks_item.stock_id';
        return response()->json([
            'data' =>  collect(DB::select($SQL))
        ]);
    }
}
