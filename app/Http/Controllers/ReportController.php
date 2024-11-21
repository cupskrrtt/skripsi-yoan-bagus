<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ProjectWorkforce;
use App\Models\ProjectMachine;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Store reports (existing functionality)
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'id_project' => 'required',
            'product' => 'required',
            'description' => 'required'
        ]);

        // Store in the database
        $report = Report::create($validated);

        // Return JSON response for AJAX
        return response()->json($report);
    }

    // Fetch all reports (existing functionality)
    public function index()
    {
        // Fetch all reports from the database
        $reports = Report::all();
        return response()->json($reports);
    }

    // Method to handle form submission on the utility page and calculate work count and machine report
    public function showUtilityPage(Request $request)
    {
        // Get the selected month and year for employee and machine reports, default to current if not provided
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        
        $monthMachine = $request->input('month_machine', date('m'));
        $yearMachine = $request->input('year_machine', date('Y'));

        // 1. Retrieve workforce data from project_workforces table based on the selected month and year
        // Group by workforce and count the tasks for each employee during the selected month
        $workReport = ProjectWorkforce::with('workforce') // Eager load the workforce relationship
            ->selectRaw('workforce_id, COUNT(*) as work_count')
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy('workforce_id')
            ->get();

        // 2. Retrieve machine data from project_machines table based on the selected month and year
        // Use 'with' to retrieve machine details from the related Machine model
        $machineReport = ProjectMachine::with('machine') // Fetch the related machine details
            ->whereYear('date', $yearMachine)
            ->whereMonth('date', $monthMachine)
            ->get();

        // 3. Retrieve reports from the Report model (if needed)
        $reports = Report::whereYear('date', $year)
                         ->whereMonth('date', $month)
                         ->get();

        // 4. Pass the workReport (employee), machineReport, and the original reports to the utility view
        return view('utility', [
            'workReport' => $workReport,      // Employee work report
            'machineReport' => $machineReport, // Machine report
            'reports' => $reports,
            'month' => $month,
            'year' => $year,
            'monthMachine' => $monthMachine,
            'yearMachine' => $yearMachine,
        ]);
    }
}
