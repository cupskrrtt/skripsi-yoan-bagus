<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public function supplierclass()
    {
        return $this->belongsTo(SupplierClass::class,'class_id');
    }
} 
