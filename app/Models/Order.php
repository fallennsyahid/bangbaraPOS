<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{

    use HasFactory;

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
        'status',
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
