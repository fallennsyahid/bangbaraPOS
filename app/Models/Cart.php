<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'product_id', 'quantity', 'sauce', 'hot_ice'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getSessionId()
    {
        return Session::getId(); // Menggunakan session Laravel
    }
}
