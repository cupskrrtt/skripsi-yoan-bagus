<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    // Relationship with MachineUse (many machines can have one use type)
    public function machineuse()
    {
        return $this->belongsTo(MachineUse::class,'use_id');
    }

    // Relationship with MachineStatus (many machines can have one status)
    public function machinestatus()
    {
        return $this->belongsTo(MachineStatus::class,'status_id');
    }

    // Relationship with Projects (many-to-many)
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'machine_project')->withPivot('Description');
    }
}
