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
        $data = $report;
        $data->worked_at = $report->worked_at?->format('Y-m-d');
        $data->reported_at = $report->reported_at?->format('Y-m-d');
        $pdf = app(PDF::class)->loadView('report', [
            'report' => $data,
            'logoBase64' => $logoBase64,
        ]);

        $fileName = $report->worked_at?->format('Ymd').$report->plant_name.'作業報告書.pdf';

        return $pdf->stream($fileName, [
            'Attachment' => false,
        ]);
    }
}
