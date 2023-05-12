<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $primaryKey = "id";
    protected $fillable = ['order_id','user_id','product_id','color_id','size_id','price','gst','quantity','total','cgst','sgst','igst','taxable'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
