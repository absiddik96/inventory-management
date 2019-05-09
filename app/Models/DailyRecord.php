<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyRecord extends Model
{
    protected $fillable = [
        'user_id', 'purpose', 'transaction_type', 'amount'
    ];
}
