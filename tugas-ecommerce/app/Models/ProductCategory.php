<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Nama tabel eksplisit, karena tabelnya tetap bernama "categories"
    // (dibuat oleh migration create_categories_table), bukan "product_categories"
    // yang biasanya ditebak otomatis oleh Laravel dari nama class ini.
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    // Relasi: satu ProductCategory bisa punya banyak Product.
    // Foreign key 'category_id' disebutkan eksplisit karena tidak sama
    // dengan tebakan default Laravel ('product_category_id').
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
