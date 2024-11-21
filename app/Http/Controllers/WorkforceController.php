<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workforce;
use App\Models\WorkforcePosition;
use App\Models\WorkforceStatus;


class WorkforceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $workforces = Workforce::with(['workforceposition', 'workforcestatus'])->get();

            return response()->json([
                'workforces' => $workforces,
            ]);
        }

        $workforces = Workforce::with(['workforceposition', 'workforcestatus'])->get();
        $workforcepositions = WorkforcePosition::all();
        $workforcestatuses = WorkforceStatus::all();

        return view('workforce',[
            'title' => 'Workforce Page',
            'workforces' => $workforces,
            'workforcepositions' => $workforcepositions,
            'workforcestatuses' => $workforcestatuses,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position_id' => 'required|exists:workforce_positions,id',
            'status_id' => 'required|exists:workforce_statuses,id',
            // Add validation rules for other fields as necessary
        ]);

        $workforce = new Workforce;
        $workforce->name = $validatedData['name'];
        $workforce->position_id = $validatedData['position_id'];
        $workforce->status_id = $validatedData['status_id'];
        $workforce->save();

        return response()->json(['message' => 'Workforce created successfully', 'Workforce' => $workforce], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workforceshow = Workforce::find((int)$id);

        if (!$workforceshow) {
            return response()->json(['error' => 'Workforce not found'], 404);
        }

        return response()->json($workforceshow);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $workforce = Workforce::find($id);

        if ($workforce) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'position_id' => 'required|exists:workforce_positions,id',
                'status_id' => 'required|exists:workforce_statuses,id',
            ]);

            $workforce->name = $validatedData['name'];
            $workforce->position_id = $validatedData['position_id'];
            $workforce->status_id = $validatedData['status_id'];

            $workforce->save();

            return response()->json(['message' => 'Workforce updated successfully', 'Workforce' => $workforce], 200);
        } else {
            return response()->json(['error' => 'Workforce not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workforce = Workforce::find($id);
        if ($workforce) {
            $workforce->delete();
            return response()->json(['message' => 'Workforce deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Workforce not found'], 404);
        }
    }
}
