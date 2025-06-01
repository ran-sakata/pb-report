<?php

namespace App\Http\Controllers\Inspection;

use App\Models\Report;
use App\Http\Controllers\Controller;

class FirstController extends Controller
{
    /**
     * Show the application second-page screen.
     */
    public function __invoke(Report $report)
    {
        $report->load([
            'eastPathPhotos',
        ]);
        return view('inspection-1', ['report' => $report]);
    }
}
