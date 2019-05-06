<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellProduct extends Model
{
    const UNVERIFIED = false;
    const VERIFIED = true;

    protected $fillable = ['invoice_no','memo_no','dealer_id','date','grand_total','amount_pay','amount_due','payment_type','transaction_id','is_verified'];

    public function sellProductItems()
    {
        return $this->hasMany(SellProductItem::class)->with('product');
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function transaction()
    {
        return $this->belongsTo(BankTransaction::class, 'transaction_id');
    }
}
