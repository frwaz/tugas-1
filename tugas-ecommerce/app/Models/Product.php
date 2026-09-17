<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'category',
    ];

    // Relasi: satu produk bisa muncul di banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
