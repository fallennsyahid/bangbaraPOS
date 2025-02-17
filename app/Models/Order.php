<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'request',
        'products',
        'total_price',
        'status',
        'payment_method',
        'payment_photo',
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
