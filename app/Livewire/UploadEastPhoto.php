<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class UploadEastPhoto extends Component
{
    use WithFileUploads;

    public Report $report;
    
    public $rowNumber;

    #[Validate('required|file|mimes:jpeg,png,jpg,gif,heic|max:10240')]
    public $east_photo;

    public function mount($report, $rowNumber)
    {
        $this->report = $report;
        $this->rowNumber = $rowNumber;
    }

    public function updatedEastPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->east_photo) {
            $eastPathPhoto = $this->report->eastPathPhotos()->where('row_number', $this->rowNumber)->first();
            if ($eastPathPhoto) {
                // 既存の写真があれば削除
                if ($eastPathPhoto->photo_path) {
                    Storage::disk('public')->delete($eastPathPhoto->photo_path);
                }
                if ($eastPathPhoto->thumbnail_path) {
                    Storage::disk('public')->delete($eastPathPhoto->thumbnail_path);
                }
            }
            // 新しい写真を保存
            $paths = \App\Services\ImageResizer::resizeAndSave($this->east_photo, 'public');
            $this->report->eastPathPhotos()->updateOrCreate(
                ['row_number' => $this->rowNumber],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail']]
            );
            session()->flash('message', '東側通路の写真をアップロードしました');
        }
    }

    public function deleteEastPhoto()
    {
        $eastPathPhoto = $this->report->eastPathPhotos()->where('row_number', $this->rowNumber)->first();
        if ($eastPathPhoto) {
            if ($eastPathPhoto->photo_path) {
                Storage::disk('public')->delete($eastPathPhoto->photo_path);
            }
            if ($eastPathPhoto->thumbnail_path) {
                Storage::disk('public')->delete($eastPathPhoto->thumbnail_path);
            }
            $eastPathPhoto->delete();
            session()->flash('message', '東側通路の写真を削除しました');
        } else {
            session()->flash('message', '削除する写真が見つかりませんでした');
        }
        $this->reset('east_photo');
    }

    public function render()
    {
        return view('livewire.upload-east-photo');
    }
}
