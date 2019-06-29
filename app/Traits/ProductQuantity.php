<?php 

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ProductQuantity {

    public function bulkStockQuantity($product_id)
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

        return DB::select($SQL);
    }


}