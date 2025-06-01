<?php

namespace App\Http\Controllers\Inspection;

use App\Models\Report;
use App\Http\Controllers\Controller;

class ForthController extends Controller
{
    /**
     * Show the application forth-page screen.
     */
    public function __invoke(Report $report)
    {
        $report->load([
            'panelArrayPhotos',
            'panelConditionPhotos',
        ]);
        
        return view('inspection-4', ['report' => $report]);
    }
}
