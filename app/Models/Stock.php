<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['category_id','product_id','unit_sell_price','quantity'];
    
    public function stockItems()
    {
        return $this->hasMany(StockItem::class)->latest();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }

    public function sumSubQuantity()
    {
        return $this->stockItems()->sum('sub_quantity');
    }
}
