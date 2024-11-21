<?php
// @AR2, start

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Machine;
use App\Models\Workforce;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();
        $machines = Machine::all();
        $workforces = Workforce::all();
        
        return view('schedule', [
            'title' => 'Schedule Page',
            'projects' => $projects,
            'machines' => $machines,
            'workforces' => $workforces,
        ]);
    }
}
// @AR2, end
