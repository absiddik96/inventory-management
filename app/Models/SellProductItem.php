<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellProductItem extends Model
{
    protected $fillable = ['sell_product_id','category_id','product_id','packet_size_id','packet_quantity','sub_quantity','unit_price','total'];

    public function sellProduct()
    {
        return $this->belongsTo(SellProduct::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function packetSize()
    {
        return $this->belongsTo(PacketSize::class);
    }

    
}
