<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'gambar',
        'stok',
        'categori_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categori_id');
    }
}
