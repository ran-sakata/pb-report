<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * Show the confirmation page.
     */
    public function __invoke(Report $report)
    {
        $logoPath = storage_path('images/logo.jpg');
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $pdf = app(PDF::class)->loadView('report', [
            'report' => $report,
            'logoBase64' => $logoBase64,
        ]);

        $fileName = $report->worked_at?->format('Ymd').$report->plant_name.'作業報告書.pdf';

        return $pdf->stream($fileName, [
            'Attachment' => false,
        ]);
    }
}
