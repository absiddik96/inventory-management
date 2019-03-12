<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = ['account_holder', 'account_number', 'details', 'bank_id', 'branch_id', 'status'];
    
    public function bank()
    {
       return $this->belongsTo(Bank::class);
    }

    public function branch()
    {
        return $this->belongsTo(BankBranch::class);
    }

    public function bankTransactions()
    {
        return $this->hasMany(BankTransaction::class);
    }

    public function totalCredit()
    {
        return $this->bankTransactions()->where('transaction_type',1)->sum('amount');
    }

    public function totalDebit()
    {
        return $this->bankTransactions()->where('transaction_type',0)->sum('amount');
    }

    public function totalAmount()
    {
        return ($this->totalCredit() - $this->totalDebit());
    }
}
