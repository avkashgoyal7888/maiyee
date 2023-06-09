<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Color;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'color_id', 'image'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function color()
    {
        return $this->belongsTo(color::class, 'color_id');
    }
}
