<?php

namespace App\Models;

use App\Scopes\ProductScope;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const ACTIVE = true;
    const DEACTIVE = false;

    protected $fillable = ['product_category_id','name','description','status'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ProductScope);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }
    
    public function getStatus()
    {
        return $this->status == self::ACTIVE;
    }
}
