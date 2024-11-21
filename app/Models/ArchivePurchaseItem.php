<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivePurchaseItem extends Model
{
    use HasFactory;
    protected $table = 'archive_purchase_items';

    protected $fillable = [
        'supplier_id', 'material_id', 'quantity', 'transaction_id'
    ];

}
