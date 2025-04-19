<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maestroerror\HeicToJpg;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageResizer
{
    /**
     * Resize and save the image.
     *
     * @param UploadedFile $file
     * @param string $disk
     * @param int $maxWidth
     * @return string
     */
    public static function resizeAndSave(UploadedFile $file, $disk = 'public', $maxWidth = 600)
    {
        $manager = new ImageManager(new Driver());

        // HEIC形式の場合、JPEGに変換
        if ($file->getClientOriginalExtension() === 'heic') {
            $tempPath = storage_path('app/temp/' . uniqid() . '.jpg');
            HeicToJpg::convert($file->getPathname(), $tempPath);
            $filePath = $tempPath;
        } else {
            $filePath = $file->getPathname();
        }

        $image = $manager->read($filePath);

        // アスペクト比を計算して縦幅を設定
        $aspectRatio = $image->width() / $image->height();
        $calculatedHeight = intval($maxWidth / $aspectRatio);

        // 縦横比を維持してリサイズ
        $image->resize($maxWidth, $calculatedHeight, function ($constraint) {
            $constraint->aspectRatio(); // 縦横比を維持
            $constraint->upsize();      // サイズが小さい場合に拡大しない
        });

        // 保存先のパスを生成
        $path = 'photos/' . uniqid() . '.jpg';

        // 画像を保存
        Storage::disk($disk)->put($path, (string) $image->encode());

        return $path;
    }
}
