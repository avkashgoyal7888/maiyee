<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LinkUser;
use App\Models\LinkProduct;

class LinkUserProduct extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id'];
    public function user()
    {
        return $this->belongsTo(Linkuser::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(LinkProduct::class, 'product_id');
    }
}
