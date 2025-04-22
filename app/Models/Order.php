<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'session_id',
        'customer_name',
        'customer_phone',
        'request',
        'products',
        'total_price',
        'status',
        'serve_option',
        'payment_method',
        'payment_photo',
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
