<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LinkCategory;
class LinkProduct extends Model
{
    use HasFactory;
    public function cat()
    {
        return $this->belongsTo(LinkCategory::class, 'link_id');
    }
}
