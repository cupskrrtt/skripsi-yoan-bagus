<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Relationship with employees (Many-to-Many)
    // @AR2, start
    //public function employees()
    //{
    //    return $this->belongsToMany(Employee::class, 'employee_project')->withPivot('Description');
    //}
    // Relationship with workforces (Many-to-Many)
    public function workforces()
    {
        return $this->belongsToMany(Workforce::class, 'project_workforces')->withPivot('id', 'date', 'task');
    }
    // @AR2, end

    // Relationship with machines (Many-to-Many)
    public function machines()
    {
        // @AR2, start
        //return $this->belongsToMany(Machine::class, 'machine_project')->withPivot('Description');
        return $this->belongsToMany(Machine::class, 'project_machines')->withPivot('id', 'date', 'task');
        // @AR2, end
    }

    // Current relationship with products (Many-to-Many)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'project_products')->withPivot('id','quantity');
    }

    // Size belongsTo relationship
    public function productsize()
    {
        return $this->belongsTo(Size::class,'size_id');
    }

    // Color belongsTo relationship
    public function productcolor()
    {
        return $this->belongsTo(Color::class,'color_id');
    }

    // Project status belongsTo relationship
    public function projectstatus()
    {
        return $this->belongsTo(ProjectStatus::class,'status_id');
    }
}
