<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantLocation extends Model
{
    use HasFactory;

    protected $fillable = ['latitude', 'longitude'];
}
