<?php
// @AR2, start

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMachine extends Model
{
    use HasFactory;
    protected $table = 'project_machines';

    protected $fillable = [
        'project_id', 'machine_id', 'date', 'task'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }
}
// @AR2, end
