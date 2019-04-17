<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = ['bulk_stock_id','product_id','unit_price','quantity','total'];

    public function bulk_stock()
    {
        return $this->belongsTo(BulkStock::class);
    }
}
