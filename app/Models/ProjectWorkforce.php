<?php
// @AR2, start

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWorkforce extends Model
{
    use HasFactory;
    protected $table = 'project_workforces';

    protected $fillable = [
        'project_id', 'workforce_id', 'date', 'task'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function workforce()
    {
        return $this->belongsTo(Workforce::class, 'workforce_id');
    }
}
// @AR2, end
