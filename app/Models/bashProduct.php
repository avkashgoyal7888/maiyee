<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bash;
use App\Models\Product;

class BashProduct extends Model
{
    use HasFactory;
    protected $table = "bash_products";
    protected $primaryKey = "id";
    protected $fillable = ['bash_id','product_id'];

    public function bash()
    {
        return $this->belongsTo(Bash::class, 'bash_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
