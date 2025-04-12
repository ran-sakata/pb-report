<?php

namespace App\Http\Controllers\Steps;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maestroerror\HeicToJpg;

class ThirdController extends Controller
{
    /**
     * Show the application third-page screen.
     */
    public function index(Report $report)
    {
        $report->load([
            'powerConverters',
            'powerConverterOverviewPhotos',
            'pipePuttyPhotos',
            'panelArrayPhotos',
            'panelConditionPhotos',
        ]);
        
        return view('third-page', ['report' => $report]);
    }

    /**
     * Update the given report.
     */
    public function update(Request $request, Report $report)
    {
        // バリデーション
        $validated = $request->validate([
            'junction_box_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'inside_junction_box_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'power_converter_overview_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'pipe_putty_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'panel_array_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
            'panel_condition_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240',
        ]);

        // 集電箱の写真
        if ($request->hasFile('junction_box_photo')) {
            if ($report->junction_box_photo) {
                Storage::disk('public')->delete($report->junction_box_photo);
            }
            $file = $request->file('junction_box_photo');
            // HEIC形式の画像をJPEGに変換
            if ($file->getClientOriginalExtension() === 'heic') {
                $path = 'photos/' . uniqid() . '.jpg';
                HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
                $report->junction_box_photo = $path;
            } else {
                $report->junction_box_photo = $file->store('photos', 'public');
            }
        }

        // 集電箱内の写真
        if ($request->hasFile('inside_junction_box_photo')) {
            if ($report->inside_junction_box_photo) {
                Storage::disk('public')->delete($report->inside_junction_box_photo);
            }
            $file = $request->file('inside_junction_box_photo');
            // HEIC形式の画像をJPEGに変換
            if ($file->getClientOriginalExtension() === 'heic') {
                $path = 'photos/' . uniqid() . '.jpg';
                HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
                $report->inside_junction_box_photo = $path;
            } else {
                $report->inside_junction_box_photo = $file->store('photos', 'public');
            }
        }

        // パワコン1～10台目の写真
    for ($i = 1; $i <= 10; $i++) {
        if ($request->hasFile("power_converter_{$i}_photo")) {
            if ($report->powerConverters()->where('index', $i)->exists()) {
                // 既存の画像を削除
                $existingPhoto = $report->powerConverters()->where('index', $i)->first();
                if ($existingPhoto && $existingPhoto->photo_path) {
                    Storage::disk('public')->delete($existingPhoto->photo_path);
                    $existingPhoto->delete();
                }
            }
            $file = $request->file("power_converter_{$i}_photo");
            if ($file->getClientOriginalExtension() === 'heic') {
                $path = 'photos/' . uniqid() . '.jpg';
                HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
            } else {
                $path = $file->store('photos', 'public');
            }

            $report->powerConverters()->updateOrCreate(
                ['report_id' => $report->id, 'index' => $i], // パワコン番号で検索
                ['photo_path' => $path]
            );
        }
    }

        // パワコン全景の写真
        if ($request->hasFile('power_converter_overview_photo')) {
            foreach ($report->powerConverterOverviewPhotos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
                $photo->delete();
            }
            foreach ($request->file('power_converter_overview_photo') as $file) {
                if ($file->getClientOriginalExtension() === 'heic') {
                    $path = 'photos/' . uniqid() . '.jpg';
                    HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
                } else {
                    $path = $file->store('photos', 'public');
                }
                $report->powerConverterOverviewPhotos()->create(['photo_path' => $path]);
            }
        }

        // 配管パテの写真
        if ($request->hasFile('pipe_putty_photo')) {
            foreach ($report->pipePuttyPhotos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
                $photo->delete();
            }
            foreach ($request->file('pipe_putty_photo') as $file) {
                if ($file->getClientOriginalExtension() === 'heic') {
                    $path = 'photos/' . uniqid() . '.jpg';
                    HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
                } else {
                    $path = $file->store('photos', 'public');
                }
                $report->pipePuttyPhotos()->create(['photo_path' => $path]);
            }
        }

        // パネルアレイの写真
        if ($request->hasFile('panel_array_photo')) {
            foreach ($report->panelArrayPhotos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
                $photo->delete();
            }
            foreach ($request->file('panel_array_photo') as $file) {
                if ($file->getClientOriginalExtension() === 'heic') {
                    $path = 'photos/' . uniqid() . '.jpg';
                    HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
                } else {
                    $path = $file->store('photos', 'public');
                }
                $report->panelArrayPhotos()->create(['photo_path' => $path]);
            }
        }

        // パネル汚れ有無の写真
        if ($request->hasFile('panel_condition_photo')) {
            foreach ($report->panelConditionPhotos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
                $photo->delete();
            }
            foreach ($request->file('panel_condition_photo') as $file) {
                if ($file->getClientOriginalExtension() === 'heic') {
                    $path = 'photos/' . uniqid() . '.jpg';
                    HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
                } else {
                    $path = $file->store('photos', 'public');
                }
                $report->panelConditionPhotos()->create(['photo_path' => $path]);
            }
        }

        $report->save();

        return redirect()->route('forth-page', ['report' => $report->id])->with('message', '目視点検２を更新しました');
    }
}
