<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Image;

class ImageResizer
{
    /**
     * Resize and save the image.
     *
     * @param UploadedFile $file
     * @param string $disk
     * @param int $maxWidth
     * @param bool $isThumbnail
     * @return array
     */
    public static function resizeAndSave(UploadedFile $file, $disk = 'public', $maxWidth = 600)
    {
        $manager = new ImageManager(new Driver());

        // HEIC形式の場合、JPEGに変換
        if (strtolower($file->getClientOriginalExtension()) === 'heic') {
            $tempPath = storage_path('app/temp/' . uniqid() . '.jpg');
            \Maestroerror\HeicToJpg::convert($file->getPathname(), $tempPath);
            $filePath = $tempPath;
        } else {
            $filePath = $file->getPathname();
        }

        // オリジナル画像保存（最大幅600px）
        $image = $manager->read($filePath);
        $aspectRatio = $image->width() / $image->height();
        $calculatedHeight = intval($maxWidth / $aspectRatio);
        $image->resize($maxWidth, $calculatedHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $originalPath = 'photos/' . uniqid() . '.jpg';
        Storage::disk($disk)->put($originalPath, (string) $image->encode());

        // サムネイル画像保存（最大幅200px）
        $thumbMaxWidth = 200;
        $thumbHeight = intval($thumbMaxWidth / $aspectRatio);
        $thumbImage = $manager->read($filePath);
        $thumbImage->resize($thumbMaxWidth, $thumbHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $thumbnailPath = 'thumbnails/' . uniqid() . '.jpg';
        Storage::disk($disk)->put($thumbnailPath, (string) $thumbImage->encode());

        // 一時ファイル削除
        if (isset($tempPath) && file_exists($tempPath)) {
            @unlink($tempPath);
        }

        return [
            'original' => $originalPath,
            'thumbnail' => $thumbnailPath,
        ];
    }
}
