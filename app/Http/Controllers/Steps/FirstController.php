<?php

namespace App\Http\Controllers\Steps;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirstController extends Controller
{
    /**
     * Show the application first-page screen.
     */
    public function create()
    {
        return view('first-page');
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reported_at' => 'required|date',
            'worked_at' => 'nullable|date',
            'plant_name' => 'nullable|string|max:255',
            'property_address' => 'nullable|string|max:255',
            'weather' => 'nullable|in:晴れ,曇り,雨',
        ]);

        $report = Report::create($validated);

        return redirect()->route('second-page', ['report' => $report->id])->with('message', '報告書を作成しました');
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        return view('first-page', [
            'report' => $report,
        ]);
    }

    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'reported_at' => 'required|date',
            'worked_at' => 'nullable|date',
            'plant_name' => 'nullable|string|max:255',
            'property_address' => 'nullable|string|max:255',
            'weather' => 'nullable|in:晴れ,曇り,雨',
        ]);

        $report->update($validated);

        return to_route('second-page', ['report' => $report->id])->with('message', '報告書を更新しました');
    }
}
