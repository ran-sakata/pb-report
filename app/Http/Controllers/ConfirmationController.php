<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    /**
     * Show the confirmation page.
     */
    public function __invoke(Report $report)
    {
        return view('confirmation', [
            'report' => $report,
        ]);
    }
}
