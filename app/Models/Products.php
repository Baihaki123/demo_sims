<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    //filable
    protected $fillable = [
        'name', 'purchase_price', 'sale_price', 'stock', 'image', 'user_id', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
