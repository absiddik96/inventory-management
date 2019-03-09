<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    protected $fillable = [
        'bank_account_id', 'supervisor_id', 'transaction_type', 'amount', 'note', 'date'
    ];
}
