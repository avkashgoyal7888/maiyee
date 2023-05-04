<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "order_details";
    protected $primaryKey = "id";
    protected $fillable = ['order_id','user_id','product_id','color_id','size_id','price','gst','quantity','total','cgst','sgst','igst','taxable'];
}
