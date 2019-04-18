<?php

namespace App\Models;

use App\Models\BankTransaction;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    const ACTIVE = TRUE;
    const DEACTIVE = FALSE;

    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 'company_address', 'registration_no', 'details', 'status',
    ];

    public function transactions()
    {
        return $this->morphMany(BankTransaction::class, 'transactionable');
    }
}
