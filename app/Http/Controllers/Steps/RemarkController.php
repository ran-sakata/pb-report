<?php

namespace App\Http\Controllers\Steps;

use App\Models\Report;
use App\Http\Controllers\Controller;

class RemarkController extends Controller
{
    /**
     * Show the application forth-page screen.
     */
    public function __invoke(Report $report)
    {
        $report->load([
            'specialNotes',
        ]);
        
        return view('remark', ['report' => $report]);
    }
}
