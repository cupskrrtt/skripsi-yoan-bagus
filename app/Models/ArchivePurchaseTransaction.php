<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivePurchaseTransaction extends Model
{
    use HasFactory;
    protected $table = 'archive_purchase_transactions';

    protected $fillable = [
        'supplier_id', 'total', 'paid', 'payment_id', 'discount'
    ];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 
        'archive_purchase_items', 'transaction_id', 'material_id')
        ->withPivot('quantity');
    } 
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function paymentmethod()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_id');
    }

    
}
