<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $fillable = ['stock_id','packet_size_id','packet_quantity','sub_quantity'];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function packetSize()
    {
        return $this->belongsTo(PacketSize::class);
    }
}
