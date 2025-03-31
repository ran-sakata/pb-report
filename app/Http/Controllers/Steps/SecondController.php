<?php

namespace App\Http\Controllers\Steps;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SavingWeeding;

class SecondController extends Controller
{
    use SavingWeeding;

    /**
     * Show the application second-page screen.
     */
    public function index(Report $report)
    {
        $report->load([
            'eastPathPhotos',
            'southPathPhotos',
            'weedingNotes',
        ]);
        return view('second-page', ['report' => $report]);
    }

    /**
     * Update the given report.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate($this->getRules());

        $this->save($request, $report, $validated);

        return redirect()->route('third-page', ['report' => $report->id])->with('message', '除草剤散布を更新しました');
    }
}
