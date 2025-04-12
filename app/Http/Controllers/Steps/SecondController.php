<?php

namespace App\Http\Controllers\Steps;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maestroerror\HeicToJpg;

class SecondController extends Controller
{
    /**
     * Show the application second-page screen.
     */
    public function index(Report $report)
    {
        $report->load([
            'eastPathPhotos',
            'southPathPhotos',
        ]);
        return view('second-page', ['report' => $report]);
    }

    /**
     * Update the given report.
     */
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'signboard_photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240', // 看板写真
            'east_photo_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240', // 東側通路
            'east_photo_path' => 'nullable|array|max:6', // 最大6件
            'south_photo_path.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,heic|max:10240', // 南側通路
            'south_photo_path' => 'nullable|array|max:6', // 最大6件
        ]);

        // データベースを更新
        $report->fill($validated)->save();

        // 列の写真の保存処理
        for ($i = 1; $i <= 10; $i++) {
            if ($request->hasFile("row_{$i}_photo_path")) {
                // 該当する行の写真を取得
                $rowPhoto = $report->rowPhotos()->where('row_number', $i)->first();

                // 既存の画像を削除
                if ($rowPhoto && $rowPhoto->photo_path) {
                    Storage::disk('public')->delete($rowPhoto->photo_path);
                }

                // 新しい画像を保存
                $file = $request->file("row_{$i}_photo_path");
                $path = $file->store('photos', 'public');

                // データベースを更新または作成
                $report->rowPhotos()->updateOrCreate(
                    ['row_number' => $i], // 行番号で検索
                    ['photo_path' => $path]
                );
            }
        }

        // 看板写真の保存処理
        if ($request->hasFile('signboard_photo_path')) {
            // 既存の画像を削除
            if ($report->signboard_photo_path) {
                Storage::disk('public')->delete($report->signboard_photo_path);
            }

            // 新しい画像を保存
            $file = $request->file('signboard_photo_path');
            if ($file->getClientOriginalExtension() === 'heic') {
                $path = 'photos/' . uniqid() . '.jpg';
                HeicToJpg::convert($file->getPathname(), storage_path("app/public/{$path}"));
                $report->signboard_photo_path = $path;
            } else {
                $report->signboard_photo_path = $file->store('photos', 'public');
            }
            $report->save();
        }

        // 東側通路の保存処理
        if ($request->hasFile('east_photo_path')) {
            // 既存の画像を削除
            foreach ($report->eastPathPhotos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
                $photo->delete();
            }

            // 新しい画像を保存
            foreach ($request->file('east_photo_path') as $file) {
                $path = $file->store('photos', 'public');
                $report->eastPathPhotos()->create(['photo_path' => $path]);
            }
        }

        // 南側通路の保存処理
        if ($request->hasFile('south_photo_path')) {
            // 既存の画像を削除
            foreach ($report->southPathPhotos as $photo) {
                Storage::disk('public')->delete($photo->photo_path);
                $photo->delete();
            }

            // 新しい画像を保存
            foreach ($request->file('south_photo_path') as $file) {
                $path = $file->store('photos', 'public');
                $report->southPathPhotos()->create(['photo_path' => $path]);
            }
        }

        return to_route('third-page', ['report' => $report->id])->with('message', '目視点検１を更新しました');
    }
}
