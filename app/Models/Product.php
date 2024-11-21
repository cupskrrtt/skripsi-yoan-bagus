<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_products');
    }
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'product_materials')->withPivot('id','quantity');
    }  
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    } 
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    } 
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    } 
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    } 
    public function sign()
    {
        return $this->belongsTo(Sign::class, 'sign_id');
    } 
    public function transactions()
    {
        return $this->belongsToMany(ArchiveSellingTransaction::class, 'archive_selling_items', 'product_id', 'transaction_id')
                    ->withPivot('quantity');
    }
    
}
