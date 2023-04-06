<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;

class SupplierAccount extends Model
{
    use HasFactory;
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
