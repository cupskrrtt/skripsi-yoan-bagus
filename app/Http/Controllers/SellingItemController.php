<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\ArchiveSellingTransaction;
use App\Models\ArchiveSellingItem;

class SellingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = ArchiveSellingItem::with([
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
        $data1 = ArchiveSellingItem::all();


        return view('sellingitem',[
            // @AR, start
            //'title' => 'Selling Transaction Page',
            'title' => 'Selling Item Page',
            // @AR, end
            'products' => $data,
            'transactions' => $data1,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
