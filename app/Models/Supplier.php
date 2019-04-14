<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    const ACTIVE = TRUE;
    const DEACTIVE = FALSE;

    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 'company_address', 'registration_no', 'details', 'status',
    ];
}
