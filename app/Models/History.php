<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
