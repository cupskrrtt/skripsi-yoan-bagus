<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workforce extends Model
{
    use HasFactory;
    public function workforceposition()
    {
        return $this->belongsTo(WorkforcePosition::class,'position_id');
    }
    public function workforcestatus()
    {
        return $this->belongsTo(WorkforceStatus::class,'status_id');
    }
}
