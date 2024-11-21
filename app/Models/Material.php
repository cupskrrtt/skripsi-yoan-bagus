<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_materials');
    }
    public function materialunit()
    {
        return $this->belongsTo(MaterialUnit::class,'unit_id');
    }
    public function materialcategory()
    {
        return $this->belongsTo(MaterialCategory::class,'category_id');
    }
    public function transactions()
    {
        return $this->belongsToMany(ArchivePurchaseTransaction::class, 'archive_purchase_items', 'material_id', 'transaction_id')
                    ->withPivot('quantity');
    }
}
