<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerClass;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::with(['customerclass'])->get();

            return response()->json([
                'customers' => $data,
            ]);
        }

        $data = Customer::with(['customerclass'])->get();
        $classes = CustomerClass::all();


        return view('customer',[
            'title' => 'Customer Page',
            'customers' => $data,
            'customerclasses' => $classes,
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
            'class_id' => 'required|exists:customer_classes,id',
            'telp' => 'required|string|max:255',
        ]);

        $data = new Customer;
        $data->name = $validatedData['name'];
        $data->class_id = $validatedData['class_id'];
        $data->telp = $validatedData['telp'];
        $data->save();

        return response()->json(['message' => 'Customer created successfully', 'customer' => $data], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Customer::find((int)$id);

        if (!$show) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json($show);
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
        $data = Customer::find($id);

        if ($data) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'class_id' => 'required|exists:customer_classes,id',
                'telp' => 'required|string|max:255',
            ]);
    
            $data = new Customer;
            $data->name = $validatedData['name'];
            $data->class_id = $validatedData['class_id'];
            $data->telp = $validatedData['telp'];
            $data->save();

            return response()->json(['message' => 'Customer updated successfully', 'customer' => $data], 200);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Customer::find($id);
        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Customer deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }
}
