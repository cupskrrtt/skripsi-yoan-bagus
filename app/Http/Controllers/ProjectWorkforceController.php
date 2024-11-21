<?php
// @AR2, start
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectWorkforce;

class ProjectWorkforceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectWorkforces = ProjectWorkforce::with('project', 'workforce')->get();
        return response()->json($projectWorkforces);
    }
}
// @AR2, end
