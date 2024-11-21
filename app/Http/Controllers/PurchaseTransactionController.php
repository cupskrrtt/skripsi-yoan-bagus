<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\Supplier;
use App\Models\PaymentMethod;
use App\Models\ArchivePurchaseTransaction;
use App\Models\ArchivePurchaseItem;

class PurchaseTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = ArchivePurchaseTransaction::with([
                'materials' => function ($query) {
                    $query->with(['materialunit', 'materialcategory'])
                          ->withPivot('quantity'); 
                },
                'supplier', 'paymentmethod'
            ])->get();
        
            $transactions = $transactions->map(function ($transaction) {
                $transaction->materials->each(function ($material) {
                    $material->unit = $material->unit;
                    $material->category = $material->category;
                    $material->stock = $material->stock;
                });
                return $transaction;
            });
        
            return response()->json([
                'transactions' => $transactions,
            ]);
        }

        $data = Material::all();
        $data1 = Supplier::all();
        $data2 = PaymentMethod::all();


        return view('purchasetransaction',[
            'title' => 'Purchase Transaction Page',
            'purchases' => $data,
            'suppliers' => $data1,
            'payments' => $data2,
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
            'supplier_id' => 'required|exists:suppliers,id',
            'total' => 'required|integer',
            'paid' => 'required|integer',
            'payment_id' => 'required|exists:payment_methods,id',
        ]);

        $transaction = \App\Models\ArchivePurchaseTransaction::create($validatedData);

        return response()->json([
            'message' => 'Purchase created successfully',
            'id' => $transaction->id,  // Return the new created ID
            'purchase' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the transaction by ID
        $show = ArchivePurchaseTransaction::with([
            'materials' => function ($query) {
                $query->with(['materialunit', 'materialcategory'])
                      ->withPivot('quantity');
            },
            'supplier.supplierclass', 'paymentmethod'
        ])->find((int)$id);
    
        // Check if the transaction was found
        if (!$show) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    
        // Map the materials to include the related details
        $show->materials->each(function ($material) {
            $material->unit = $material->unit;
            $material->category = $material->category;
            $material->stock = $material->stock;
            $material->quantity = $material->pivot->quantity;
        });
    
        // Return the transaction with materials and related details
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
        $transaction = ArchivePurchaseTransaction::find($id);

        if ($transaction) {
            $validatedData = $request->validate([
                'supplier_id' => 'required|exists:suppliers,id',
                'total' => 'required|integer',
                'paid' => 'required|integer',
                'payment_id' => 'required|exists:payment_methods,id',
            ]);

            $transaction->supplier_id = $validatedData['supplier_id'];
            $transaction->total = $validatedData['total'];
            $transaction->paid = $validatedData['paid'];
            $transaction->payment_id = $validatedData['payment_id'];

            $transaction->save();

            return response()->json(['message' => 'Transaction updated successfully', 'material' => $transaction], 200);
        } else {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = ArchivePurchaseTransaction::find($id);
        if ($transaction) {
            $transaction->delete();
            return response()->json(['message' => 'Transaction deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    }
    
    public function updateItem(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_id' => 'required|exists:archive_purchase_transactions,id',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:materials,id', 
            'items.*.quantity' => 'required|integer|min:0', 
        ]);

        $transactionId = $validatedData['transaction_id'];
        $items = $validatedData['items'];
        $transaction = ArchivePurchaseTransaction::with('materials')->find($transactionId);

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], Response::HTTP_NOT_FOUND);
        }

        $existingItems = $transaction->materials->pluck('id')->toArray();
        $itemsToAttach = [];
        $itemsToUpdate = [];
        $itemsToDetach = [];

        foreach ($items as $item) {
            $itemId = $item['id'];
            $quantity = $item['quantity'];

            if (in_array($itemId, $existingItems)) {
                $itemsToUpdate[$itemId] = ['quantity' => $quantity];
            } else {
                $itemsToAttach[$itemId] = ['quantity' => $quantity];
            }
        }

        $itemsToDetach = array_diff($existingItems, array_column($items, 'id'));

        if (!empty($itemsToDetach)) {
            foreach ($itemsToDetach as $itemId) {
                $transaction->materials()->detach($itemId);
            }
        }

        if (!empty($itemsToAttach)) {
            foreach ($itemsToAttach as $itemId => $data) {
                $transaction->materials()->attach($itemId, $data);
            }
        }

        if (!empty($itemsToUpdate)) {
            foreach ($itemsToUpdate as $itemId => $data) {
                $transaction->materials()->updateExistingPivot($itemId, $data);
            }
        }

        return response()->json(['message' => 'Transaction items updated successfully']);
    }
}
