<?php

namespace App\Models;

use App\Models\BankTransaction;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    const ACTIVE = TRUE;
    const DEACTIVE = FALSE;

    protected $fillable = [
        'name', 'email', 'phone', 'nid', 'shop_name', 'trad_license', 'address', 'status'
    ];

    public function transactions()
    {
        return $this->morphMany(BankTransaction::class, 'transactionable');
    }

    public function buyProduct()
    {
        return $this->hasMany(SellProduct::class);
    }

    public function previousDue()
    {
        return $this->buyProduct()->sum('amount_due');
    }
}
