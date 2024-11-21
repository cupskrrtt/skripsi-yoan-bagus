<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use App\Models\Category;
use App\Models\Color;
use App\Models\Sign;
use App\Models\Material;
use App\Models\MaterialUnit;
use App\Models\MaterialCategory;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with([
                'materials' => function ($query) {
                    $query->with(['materialunit', 'materialcategory'])
                          ->withPivot('quantity'); 
                },
                'type', 'category', 'size', 'color', 'sign'
            ])->get();
        
            $products = $products->map(function ($product) {
                $product->materials->each(function ($material) {
                    $material->unit = $material->materialunit;
                    $material->category = $material->materialcategory;
                    unset($material->materialunit, $material->materialcategory);
                });
                return $product;
            });
        
            return response()->json([
                'products' => $products,
            ]);
        }
        
        $products = Product::with('type', 'category', 'size', 'color', 'sign')->get();
        $typesss = Type::all();
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $signs = Sign::all();
        return view('product', [
            'products' => $products,
            'title' => 'Product Page',
            'typess' => $typesss,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
            'signs' => $signs
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'category_id' => 'required|exists:categories,id',
            'size_id' => 'required|exists:sizes,id',
            'color_id' => 'required|exists:colors,id',
            'sign_id' => 'required|exists:signs,id',
            'code' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);
        $product = new Product;
        $product->name = $validatedData['name'];
        $product->type_id = $validatedData['type_id'];
        $product->category_id = $validatedData['category_id'];
        $product->size_id = $validatedData['size_id'];
        $product->color_id = $validatedData['color_id'];
        $product->sign_id = $validatedData['sign_id'];
        $product->code = $validatedData['code'];
        $product->purchase_price = $validatedData['purchase_price'];
        $product->selling_price = $validatedData['selling_price'];
        $product->stock = $validatedData['stock'];
        $product->save();
    
        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }

    public function show(string $id)
    {
        $productshow = Product::find((int)$id);
        if (!$productshow) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($productshow);
    }

    public function edit(string $id)
    {
        $popupText = "This is a simple pop-up text.";
        return response($popupText);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'type_id' => 'required|exists:types,id',
                'category_id' => 'required|exists:categories,id',
                'size_id' => 'required|exists:sizes,id',
                'color_id' => 'required|exists:colors,id',
                'sign_id' => 'required|exists:signs,id',
                'code' => 'required|string|max:255',
                'purchase_price' => 'required|numeric',
                'selling_price' => 'required|numeric',
                'stock' => 'required|integer',
            ]);

            $product->name = $validatedData['name'];
            $product->type_id = $validatedData['type_id'];
            $product->category_id = $validatedData['category_id'];
            $product->size_id = $validatedData['size_id'];
            $product->color_id = $validatedData['color_id'];
            $product->sign_id = $validatedData['sign_id'];
            $product->code = $validatedData['code'];
            $product->purchase_price = $validatedData['purchase_price'];
            $product->selling_price = $validatedData['selling_price'];
            $product->stock = $validatedData['stock'];

            $product->save();

            return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }


public function updateProductMaterials(Request $request, $id)
{
    $request->validate([
        'productId' => 'required|exists:products,id',
        'materials' => 'required|array', 
        'materials.*.id' => 'required|exists:materials,id', 
        'materials.*.quantity' => 'required|integer|min:0', 
        'materials.*.name' => 'required|string', 
        'materials.*.purchase_price' => 'required|numeric|min:0',
        'materials.*.unit' => 'required|string', 
    ]);

    $productId = $request->productId;
    $materials = $request->materials;
    $product = Product::with('materials')->find($productId);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], Response::HTTP_NOT_FOUND);
    }

    $existingMaterials = $product->materials->pluck('id')->toArray();
    $materialsToAttach = [];
    $materialsToUpdate = [];
    $materialsToDetach = [];

    foreach ($materials as $material) {
        $materialId = $material['id'];
        $quantity = $material['quantity'];

        if (in_array($materialId, $existingMaterials)) {
            $materialsToUpdate[$materialId] = ['quantity' => $quantity];
        } else {
            $materialsToAttach[$materialId] = ['quantity' => $quantity];
        }
    }

    $materialsToDetach = array_diff($existingMaterials, array_column($materials, 'id'));

    if (!empty($materialsToDetach)) {
        foreach ($materialsToDetach as $materialId) {
            $product->materials()->detach($materialId);
        }
    }

    if (!empty($materialsToAttach)) {
        foreach ($materialsToAttach as $materialId => $data) {
            $product->materials()->attach($materialId, $data);
        }
    }

    if (!empty($materialsToUpdate)) {
        foreach ($materialsToUpdate as $materialId => $data) {
            $product->materials()->updateExistingPivot($materialId, $data);
        }
    }

    return response()->json(['message' => 'Product materials updated successfully']);
}

    public function createProductMaterials(Request $request)
    {
        $request->validate([
            'materials' => 'required|array', 
            'materials.*.id' => 'required|exists:materials,id',
            'materials.*.quantity' => 'required|integer|min:0',
            'materials.*.name' => 'required|string',
            'materials.*.purchase_price' => 'required|numeric|min:0',
            'materials.*.unit' => 'required|string',
        ]);

        $productId = $request->productId;
        $materials = $request->materials;
        $product = Product::findOrFail($productId);

        foreach ($materials as $material) {
            $materialId = $material['id'];
            $quantity = $material['quantity'];

            $product->materials()->attach($materialId, [
                'quantity' => $quantity,
            ]);
        }
        return response()->json(['message' => 'Product materials created successfully']);
    }
}
