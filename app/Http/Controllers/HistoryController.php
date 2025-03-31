<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index()
    {
        $reports = Report::select([
            'id',
            'reported_at',
            'worked_at',
            'plant_name',
            'updated_at',
        ])
            ->orderBy('updated_at', 'desc')
            ->paginate();

        return view('history', ['reports' => $reports]);
    }
}
