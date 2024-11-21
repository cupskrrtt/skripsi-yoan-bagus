<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public function customerclass()
    {
        return $this->belongsTo(CustomerClass::class,'class_id');
    }
}
