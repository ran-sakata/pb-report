<?php

namespace App\Http\Controllers\Inspection;

use App\Models\Report;
use App\Http\Controllers\Controller;

class SecondController extends Controller
{
    /**
     * Show the application second-page screen.
     */
    public function __invoke(Report $report)
    {
        $report->load([
            'powerConverters',
        ]);
        
        return view('inspection-2', ['report' => $report]);
    }
}
