<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class UploadOutsideJunctionBoxPhoto extends Component
{
    use WithFileUploads;

    public Report $report;

    #[Validate('nullable|file|mimes:jpeg,png,jpg,gif,heic|max:10240')]
    public $outside_junction_box_photo;

    public function mount($report)
    {
        $this->report = $report;
    }

    public function updatedOutsideJunctionBoxPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->outside_junction_box_photo) {
            if ($this->report->junction_box_photo) {
                Storage::disk('public')->delete($this->report->junction_box_photo);
            }
            if ($this->report->junction_box_thumbnail_path) {
                Storage::disk('public')->delete($this->report->junction_box_thumbnail_path);
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->outside_junction_box_photo, 'public');
            $this->report->junction_box_photo = $paths['original'];
            $this->report->junction_box_thumbnail_path = $paths['thumbnail'] ?? null;
            $this->report->save();
            session()->flash('message', '集電箱の写真をアップロードしました');
        }
    }

    public function deleteOutsideJunctionBoxPhoto()
    {
        if ($this->report->junction_box_photo) {
            Storage::disk('public')->delete($this->report->junction_box_photo);
            $this->report->junction_box_photo = null;
        }
        if ($this->report->junction_box_thumbnail_path) {
            Storage::disk('public')->delete($this->report->junction_box_thumbnail_path);
            $this->report->junction_box_thumbnail_path = null;
        }
        $this->report->save();
        $this->reset('outside_junction_box_photo');
        session()->flash('message', '集電箱の写真を削除しました');
    }

    public function render()
    {
        return view('livewire.upload-outside-junction-box-photo');
    }
}
