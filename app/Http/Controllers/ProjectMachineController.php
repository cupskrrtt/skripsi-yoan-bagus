<?php
// @AR2, start
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMachine;

class ProjectMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectMachines = ProjectMachine::with('project', 'machine')->get();
        return response()->json($projectMachines);
    }
}
// @AR2, end
