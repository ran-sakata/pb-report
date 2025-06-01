<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class UploadWestPhoto extends Component
{
    use WithFileUploads;

    public Report $report;
    
    public $rowNumber;

    #[Validate('required|file|mimes:jpeg,png,jpg,gif,heic|max:10240')]
    public $west_photo;

    public function mount($report, $rowNumber)
    {
        $this->report = $report;
        $this->rowNumber = $rowNumber;
    }

    public function updatedWestPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->west_photo) {
            $westPathPhoto = $this->report->westPathPhotos()->where('row_number', $this->rowNumber)->first();
            if ($westPathPhoto) {
                // 既存の写真があれば削除
                if ($westPathPhoto->photo_path) {
                    Storage::disk('public')->delete($westPathPhoto->photo_path);
                }
                if ($westPathPhoto->thumbnail_path) {
                    Storage::disk('public')->delete($westPathPhoto->thumbnail_path);
                }
            }
            // 新しい写真を保存
            $paths = \App\Services\ImageResizer::resizeAndSave($this->west_photo, 'public');
            $this->report->westPathPhotos()->updateOrCreate(
                ['row_number' => $this->rowNumber],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail']]
            );
            session()->flash('message', '西側通路の写真をアップロードしました');
        }
    }

    public function deleteWestPhoto()
    {
        $westPathPhoto = $this->report->westPathPhotos()->where('row_number', $this->rowNumber)->first();
        if ($westPathPhoto) {
            if ($westPathPhoto->photo_path) {
                Storage::disk('public')->delete($westPathPhoto->photo_path);
            }
            if ($westPathPhoto->thumbnail_path) {
                Storage::disk('public')->delete($westPathPhoto->thumbnail_path);
            }
            $westPathPhoto->delete();
            session()->flash('message', '西側通路の写真を削除しました');
        } else {
            session()->flash('message', '削除する写真が見つかりませんでした');
        }
        $this->reset('west_photo');
    }

    public function render()
    {
        return view('livewire.upload-west-photo');
    }
}
