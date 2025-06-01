<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class UploadSignboardPhoto extends Component
{
    use WithFileUploads;

    public Report $report;

    #[Validate('required|file|mimes:jpeg,png,jpg,gif,heic|max:10240')]
    public $signboard_photo;

    public function mount($report)
    {
        $this->report = $report;
    }

    public function updatedSignboardPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();
        
        if ($this->signboard_photo) {
            if ($this->report->signboard_photo_path) {
                Storage::disk('public')->delete($this->report->signboard_photo_path);
            }
            if ($this->report->signboard_thumbnail_path) {
                Storage::disk('public')->delete($this->report->signboard_thumbnail_path);
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->signboard_photo, 'public');
            $this->report->signboard_photo_path = $paths['original'];
            $this->report->signboard_thumbnail_path = $paths['thumbnail'] ?? null;
            $this->report->save();
            session()->flash('message', '看板写真をアップロードしました');
        }
    }

    public function deleteSignboardPhoto()
    {
        if ($this->report->signboard_photo_path) {
            Storage::disk('public')->delete($this->report->signboard_photo_path);
            $this->report->signboard_photo_path = null;
        }
        if ($this->report->signboard_thumbnail_path) {
            Storage::disk('public')->delete($this->report->signboard_thumbnail_path);
            $this->report->signboard_thumbnail_path = null;
        }
        $this->report->save();
        $this->reset('signboard_photo');
        session()->flash('message', '看板写真を削除しました');
    }

    public function render()
    {
        return view('livewire.upload-signboard-photo');
    }
}
