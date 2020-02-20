<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = ['staff_id','status','amount','note','date'];
    
    public function staff()
    {
        return $this->belongsTo('App\Models\Staff');
    }
}
