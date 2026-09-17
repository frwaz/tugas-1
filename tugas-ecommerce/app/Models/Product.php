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
        'category_id',
    ];

    // Relasi: satu produk termasuk dalam satu ProductCategory
    // Foreign key 'category_id' cocok dengan nama method relasi ini ('category'),
    // jadi tidak perlu disebutkan eksplisit.
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    // Relasi: satu produk bisa muncul di banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
