<?php

namespace App\Http\Controllers\Admin\BulkStock;

use App\Models\PurchaseItem;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PurchaseItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products($category_id)
    {
        $SQL = 'SELECT p_items.product_id, products.name as product_name,p_items.sum_quantity as purchase_quantity,COALESCE(stocks.quantity,0) as stock_quantity,     (p_items.sum_quantity - COALESCE(stocks.quantity,0)) as quantity
                FROM (SELECT *,sum(quantity) as sum_quantity FROM purchase_items GROUP by product_id) as p_items
                LEFT JOIN stocks
                ON stocks.product_id = p_items.product_id
                LEFT JOIN products
                ON products.id = p_items.product_id
                WHERE products.status = 1
                AND p_items.category_id = '.$category_id.'
                GROUP BY product_id
                ORDER BY products.name';

        $products = DB::select($SQL);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $products,
            ]);
        }

        return $products;
    }
}
