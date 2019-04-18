<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    const TRANSACTION_TYPE_DEBIT = 0;
    const TRANSACTION_TYPE_CREDIT = 1;

    protected $fillable = [
        'bank_id','branch_id','bank_account_id', 'supervisor_id', 'transaction_type', 'amount', 'note', 'transaction_date','transactionable_id','transactionable_type'
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
