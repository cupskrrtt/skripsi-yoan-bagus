<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveSellingItem extends Model
{
    use HasFactory;
    protected $table = 'archive_selling_items';

    protected $fillable = [
        'customer_id', 'product_id', 'quantity', 'transaction_id'
    ];

}
