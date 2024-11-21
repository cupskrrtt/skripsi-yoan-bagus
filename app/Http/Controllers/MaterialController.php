<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialUnit;
use App\Models\MaterialCategory;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $materials = Material::with(['materialunit', 'materialcategory'])->get();

            return response()->json([
                'materials' => $materials,
            ]);
        }

        $materials = Material::with(['materialunit', 'materialcategory'])->get();
        $materialunits = MaterialUnit::all();
        $materialcategories = MaterialCategory::all();

        return view('material',[
            // @AR, start
            'title' => 'Material Page',
            // @AR, end
            'materials' => $materials,
            'materialunits' => $materialunits,
            'materialcategories' => $materialcategories,
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
            'stock' => 'required|integer',
            'unit_id' => 'required|exists:material_units,id',
            'category_id' => 'required|exists:material_categories,id',
            'code' => 'required|string|max:255|unique:materials,code',
            'purchase_price' => 'required|numeric',
            // Add validation rules for other fields as necessary
        ]);

        $material = new Material;
        $material->name = $validatedData['name'];
        $material->stock = $validatedData['stock'];
        $material->unit_id = $validatedData['unit_id'];
        $material->category_id = $validatedData['category_id'];
        $material->code = $validatedData['code'];
        $material->purchase_price = $validatedData['purchase_price'];

        $material->save();

        return response()->json(['message' => 'Material created successfully', 'material' => $material], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $materialshow = Material::find((int)$id);

        if (!$materialshow) {
            return response()->json(['error' => 'Material not found'], 404);
        }

        return response()->json($materialshow);
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
        $material = Material::find($id);

        if ($material) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'stock' => 'required|integer',
                'unit_id' => 'required|exists:material_units,id',
                'category_id' => 'required|exists:material_categories,id',
                'code' => 'required|string|max:255|unique:materials,code,' . $material->id,
                'purchase_price' => 'required|numeric',
            ]);

            $material->name = $validatedData['name'];
            $material->stock = $validatedData['stock'];
            $material->unit_id = $validatedData['unit_id'];
            $material->category_id = $validatedData['category_id'];
            $material->code = $validatedData['code'];
            $material->purchase_price = $validatedData['purchase_price'];

            $material->save();

            return response()->json(['message' => 'Material updated successfully', 'material' => $material], 200);
        } else {
            return response()->json(['error' => 'Material not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::find($id);
        if ($material) {
            $material->delete();
            return response()->json(['message' => 'Material deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Material not found'], 404);
        }
    }

    public function bottomMaterials()
    {
        $materials = Material::all();
        return response()->json($materials);
    }

}
