<?php
// @AR, start

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfitReportView;

class ProfitReportViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $profitReportView = ProfitReportView::all();

            return response()->json([
                'profitReportView' => $profitReportView,
            ]);
        }
        
        $profitReportView = ProfitReportView::all();
        
        return view('profitReportView', [
            'profitReportView' => $profitReportView
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
// @AR, end
