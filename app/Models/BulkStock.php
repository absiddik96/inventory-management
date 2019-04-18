<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BulkStock extends Model
{
    const UNVERIFIED = false;
    const VERIFIED = true;

    protected $fillable = ['supplier_id','lc_number','date','grand_total','amount_pay','amount_due','payment_type','transaction_id','is_verified'];

    public function transaction()
    {
        return $this->belongsTo(BankTransaction::class, 'transaction_id');
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class)->with('product');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
