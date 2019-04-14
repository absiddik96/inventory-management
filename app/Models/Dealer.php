<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    const ACTIVE = TRUE;
    const DEACTIVE = FALSE;

    protected $fillable = [
        'name', 'email', 'phone', 'nid', 'shop_name', 'trad_license', 'address', 'status'
    ];
}
