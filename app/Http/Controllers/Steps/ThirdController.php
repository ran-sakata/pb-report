<?php

namespace App\Http\Controllers\Steps;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThirdController extends Controller
{
    /**
     * Show the application third-page screen.
     */
    public function index(Report $report)
    {
        return view('third-page', ['report' => $report]);
    }

    /**
     * Update the given report.
     */
    public function update(Request $request, Report $report)
    {
        // TODO:
        // $validated = $request->validate([
        //     'reported_at' => 'required|date',
        //     'worked_at' => 'required|date',
        //     'plant_name' => 'required|string|max:255',
        //     'property_address' => 'required|string|max:255',
        // ]);

        // $report->update($validated);

        return to_route('forth-page', ['report' => $report]);
    }
}
