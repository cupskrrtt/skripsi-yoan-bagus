<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\Supplier;
use App\Models\PaymentMethod;
use App\Models\ArchivePurchaseTransaction;
use App\Models\ArchivePurchaseItem;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $transactions = ArchivePurchaseItem::with([
                'materials' => function ($query) {
                    $query->with(['unit', 'category', 'stock',])
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
        $data1 = ArchivePurchaseItem::all();


        return view('purchaseitem',[
            // @AR, start
            // 'title' => 'Purchase Transaction Page',
            'title' => 'Purchase Item Page',
            // @AR, end
            'materials' => $data,
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
