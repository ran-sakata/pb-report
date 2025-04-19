<?php

namespace App\Http\Controllers\Steps;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageResizer;

class ForthController extends Controller
{
    /**
     * Show the application forth-page screen.
     */
    public function index(Report $report)
    {
        $report->load([
            'specialNotes',
        ]);
        
        return view('forth-page', ['report' => $report]);
    }

    /**
     * Update the given report.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'remarks' => 'nullable|string',
            'special_note_title_1' => 'nullable|string|max:255',
            'special_note_photo_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'special_note_description_1' => 'nullable|string',
            'special_note_title_2' => 'nullable|string|max:255',
            'special_note_photo_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'special_note_description_2' => 'nullable|string',
            'special_note_title_3' => 'nullable|string|max:255',
            'special_note_photo_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'special_note_description_3' => 'nullable|string',
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $title = $request->input("special_note_title_{$i}");
            $description = $request->input("special_note_description_{$i}");

            if ($request->hasFile("special_note_photo_{$i}")) {
                // 既存の画像を削除
                $existingNote = $report->specialNotes()->where('index', $i)->first();
                if ($existingNote && $existingNote->photo_path) {
                    Storage::disk('public')->delete($existingNote->photo_path);
                }

                // 新しい画像を保存
                $file = $request->file("special_note_photo_{$i}");
                $path = ImageResizer::resizeAndSave($file);

                $report->specialNotes()->updateOrCreate(
                    ['report_id' => $report->id, 'index' => $i],
                    ['title' => $title, 'photo_path' => $path, 'description' => $description]
                );
            } else {
                $report->specialNotes()->updateOrCreate(
                    ['report_id' => $report->id, 'index' => $i],
                    ['title' => $title, 'description' => $description]
                );
            }
        }

        $report->remarks = $validated['remarks'] ?? $report->remarks;
        $report->save();
        
        return redirect()->route('confirmation', ['report' => $report->id])->with('message', 'その他を更新しました');
    }
}
