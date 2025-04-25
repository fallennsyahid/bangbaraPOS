<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempOrder extends Model
{
    protected $fillable = [
        'order_id',
        'session_id',
        'customer_name',
        'customer_phone',
        'request',
        'products',
        'total_price',
        'serve_option',
        'payment_method',
    ];
}
