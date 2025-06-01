<?php

namespace App\Http\Controllers\Inspection;

use App\Models\Report;
use App\Http\Controllers\Controller;

class ThirdController extends Controller
{
    /**
     * Show the application third-page screen.
     */
    public function __invoke(Report $report)
    {
        $report->load([
            'powerConverterPhotos',
            'pipePuttyPhotos',
        ]);
        
        return view('inspection-3', ['report' => $report]);
    }
}
