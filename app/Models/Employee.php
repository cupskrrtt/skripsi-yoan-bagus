<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['Nama'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'Employee_Project', 'ID_employee', 'ID_Project');
    }

    public function reports()
    {
        return $this->hasMany(EmployeeReport::class, 'ID_employee');
    }
}
