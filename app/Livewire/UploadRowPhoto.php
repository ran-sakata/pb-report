<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class UploadRowPhoto extends Component
{
    use WithFileUploads;

    public Report $report;
    
    public $rowNumber;

    #[Validate('required|file|mimes:jpeg,png,jpg,gif,heic|max:10240')]
    public $row_photo;

    public function mount($report, $rowNumber)
    {
        $this->report = $report;
        $this->rowNumber = $rowNumber;
    }

    public function updatedRowPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();
        
        if ($this->row_photo) {
            $rowPhoto = $this->report->rowPhotos()->where('row_number', $this->rowNumber)->first();
            if ($rowPhoto && $rowPhoto->photo_path) {
                Storage::disk('public')->delete($rowPhoto->photo_path);
            }
            if ($rowPhoto && $rowPhoto->thumbnail_path) {
                Storage::disk('public')->delete($rowPhoto->thumbnail_path);
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->row_photo);
            $this->report->rowPhotos()->updateOrCreate(
                ['row_number' => $this->rowNumber],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail']]
            );
            session()->flash('message', "列{$this->rowNumber}の写真をアップロードしました");
        }
    }

    public function deleteRowPhoto()
    {
        $rowPhoto = $this->report->rowPhotos()->where('row_number', $this->rowNumber)->first();
        if ($rowPhoto) {
            if ($rowPhoto->photo_path) {
                Storage::disk('public')->delete($rowPhoto->photo_path);
            }
            if ($rowPhoto->thumbnail_path) {
                Storage::disk('public')->delete($rowPhoto->thumbnail_path);
            }
            $rowPhoto->delete();
        }
        $this->reset('row_photo');
        session()->flash('message', "列{$this->rowNumber}の写真を削除しました");
    }

    public function render()
    {
        return view('livewire.upload-row-photo');
    }
}
