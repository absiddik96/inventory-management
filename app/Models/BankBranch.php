<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    protected $guarded = [];

    public function bankAccounts()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
