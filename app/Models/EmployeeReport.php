<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeReport extends Model
{
    protected $table = 'employee_report';
    public $timestamps = false;

    protected $fillable = ['ID_employee', 'ID_project', 'Date', 'Report'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'ID_employee');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'ID_project');
    }
}
