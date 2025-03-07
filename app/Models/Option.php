<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'category_id',
        'nama_option',
        'tidak_berlaku_pada',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
