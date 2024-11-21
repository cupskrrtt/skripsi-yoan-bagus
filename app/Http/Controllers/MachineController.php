<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\MachineUse;
use App\Models\MachineStatus;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $machines = Machine::with(['machineuse', 'machinestatus'])->get();

            return response()->json([
                'machines' => $machines,
            ]);
        }

        $machines = Machine::with(['machineuse', 'machinestatus'])->get();
        $machineuses = MachineUse::all();
        $machinestatuses = MachineStatus::all();

        return view('machine',[
            'title' => 'Machine Page',
            'machines' => $machines,
            'machineuses' => $machineuses,
            'machinestatuses' => $machinestatuses,
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
            'use_id' => 'required|exists:machine_uses,id',
            'status_id' => 'required|exists:machine_statuses,id',
            // Add validation rules for other fields as necessary
        ]);

        $machine = new Machine;
        $machine->name = $validatedData['name'];
        $machine->use_id = $validatedData['use_id'];
        $machine->status_id = $validatedData['status_id'];
        $machine->save();

        return response()->json(['message' => 'Machine created successfully', 'machine' => $machine], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $machineshow = Machine::find((int)$id);

        if (!$machineshow) {
            return response()->json(['error' => 'Machine not found'], 404);
        }

        return response()->json($machineshow);
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
        $machine = Machine::find($id);

        if ($machine) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'use_id' => 'required|exists:machine_uses,id',
                'status_id' => 'required|exists:machine_statuses,id',
            ]);

            $machine->name = $validatedData['name'];
            $machine->use_id = $validatedData['use_id'];
            $machine->status_id = $validatedData['status_id'];

            $machine->save();

            return response()->json(['message' => 'Machine updated successfully', 'machine' => $machine], 200);
        } else {
            return response()->json(['error' => 'Machine not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $machine = Machine::find($id);
        if ($machine) {
            $machine->delete();
            return response()->json(['message' => 'Machine deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Machine not found'], 404);
        }
    }
}
