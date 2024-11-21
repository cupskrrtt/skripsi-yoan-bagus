<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\ArchiveSellingTransaction;
use App\Models\ArchiveSellingItem;

class SellingTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = ArchiveSellingTransaction::with([
                'products' => function ($query) {
                    $query->with(['type', 'category', 'size', 'color', 'sign'])
                          ->withPivot('quantity'); 
                },
                'customer', 'paymentmethod'
            ])->get();
        
            $transactions = $transactions->map(function ($transaction) {
                $transaction->products->each(function ($product) {
                    $product->type = $product->type;
                    $product->category = $product->category;
                    $product->size = $product->size;
                    $product->color = $product->color;
                    $product->sign = $product->sign;
                });
                return $transaction;
            });
        
            return response()->json([
                'transactions' => $transactions,
            ]);
        }

        $data = Product::all();
        $data1 = Customer::all();
        $data2 = PaymentMethod::all();


        return view('sellingtransaction',[
            'title' => 'Selling Transaction Page',
            'sellings' => $data,
            'customers' => $data1,
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
            'customer_id' => 'required|exists:customers,id',
            'total' => 'required|integer',
            'paid' => 'required|integer',
            'payment_id' => 'required|exists:payment_methods,id',
        ]);

        $transaction = \App\Models\ArchiveSellingTransaction::create($validatedData);

        return response()->json([
            'message' => 'Selling created successfully',
            'id' => $transaction->id,  // Return the new created ID
            'selling' => $transaction
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the transaction by ID
        $show = ArchiveSellingTransaction::with([
            'products' => function ($query) {
                $query->with(['type', 'category', 'size', 'color', 'sign'])
                      ->withPivot('quantity');
            },
            'customer.customerclass', 'paymentmethod'
        ])->find((int)$id);
    
        // Check if the transaction was found
        if (!$show) {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    
        // Map the products to include the related details
        $show->products->each(function ($product) {
            $product->type = $product->type;
            $product->category = $product->category;
            $product->size = $product->size;
            $product->color = $product->color;
            $product->sign = $product->sign;
            $product->quantity = $product->pivot->quantity;
        });
    
        // Return the transaction with products and related details
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
        $transaction = ArchiveSellingTransaction::find($id);

        if ($transaction) {
            $validatedData = $request->validate([
                'customer_id' => 'required|exists:customers,id',
                'total' => 'required|integer',
                'paid' => 'required|integer',
                'payment_id' => 'required|exists:payment_methods,id',
            ]);

            $transaction->customer_id = $validatedData['customer_id'];
            $transaction->total = $validatedData['total'];
            $transaction->paid = $validatedData['paid'];
            $transaction->payment_id = $validatedData['payment_id'];

            $transaction->save();

            return response()->json(['message' => 'Transaction updated successfully', 'product' => $transaction], 200);
        } else {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = ArchiveSellingTransaction::find($id);
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
            'transaction_id' => 'required|exists:archive_selling_transactions,id',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:products,id', 
            'items.*.quantity' => 'required|integer|min:0', 
        ]);

        $transactionId = $validatedData['transaction_id'];
        $items = $validatedData['items'];
        $transaction = ArchiveSellingTransaction::with('products')->find($transactionId);

        if (!$transaction) {
            return response()->json(['error' => 'Transaction not found'], Response::HTTP_NOT_FOUND);
        }

        $existingItems = $transaction->products->pluck('id')->toArray();
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
                $transaction->products()->detach($itemId);
            }
        }

        if (!empty($itemsToAttach)) {
            foreach ($itemsToAttach as $itemId => $data) {
                $transaction->products()->attach($itemId, $data);
            }
        }

        if (!empty($itemsToUpdate)) {
            foreach ($itemsToUpdate as $itemId => $data) {
                $transaction->products()->updateExistingPivot($itemId, $data);
            }
        }

        return response()->json(['message' => 'Transaction items updated successfully']);
    }
}
