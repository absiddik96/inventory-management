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
}
