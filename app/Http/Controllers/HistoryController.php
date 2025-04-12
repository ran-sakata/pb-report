<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'sort' => 'sometimes|string|in:updated_at__desc,updated_at__asc,reported_at__desc,reported_at__asc,worked_at__desc,worked_at__asc',
        ]);

        $sort = $validated['sort'] ?? 'updated_at__desc';
        [$key, $value] = explode('__', $sort);

        $reports = Report::select([
            'id',
            'reported_at',
            'worked_at',
            'plant_name',
            'updated_at',
        ])
            ->orderBy($key, $value)
            ->paginate();

        return view('history', ['reports' => $reports]);
    }
}
