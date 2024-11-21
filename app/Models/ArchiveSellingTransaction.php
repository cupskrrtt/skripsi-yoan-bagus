<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveSellingTransaction extends Model
{
    use HasFactory;
    protected $table = 'archive_selling_transactions';

    protected $fillable = [
        'customer_id', 'total', 'paid', 'payment_id', 'discount'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 
        'archive_selling_items', 'transaction_id', 'product_id')
        ->withPivot('quantity');
    } 
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function paymentmethod()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_id');
    }

    
}
