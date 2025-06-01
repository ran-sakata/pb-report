<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class UploadPanelConditionPhoto extends Component
{
    use WithFileUploads;

    public Report $report;
    public int $index;

    public $panel_condition_photo;

    protected function rules()
    {
        return [
            'panel_condition_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,heic|max:10240',
        ];
    }

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
    }

    public function updatedPanelConditionPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->panel_condition_photo) {
            $existingPhoto = $this->report->panelConditionPhotos()->where('index', $this->index)->first();
            if ($existingPhoto) {
                if ($existingPhoto->photo_path) {
                    Storage::disk('public')->delete($existingPhoto->photo_path);
                }
                if ($existingPhoto->thumbnail_path) {
                    Storage::disk('public')->delete($existingPhoto->thumbnail_path);
                }
                $existingPhoto->delete();
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->panel_condition_photo, 'public');
            $this->report->panelConditionPhotos()->updateOrCreate(
                ['report_id' => $this->report->id, 'index' => $this->index],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail'] ?? null]
            );
            $this->report->refresh();
            session()->flash('message', "パネル汚れ画像{$this->index}をアップロードしました");
            $this->reset('panel_condition_photo');
        }
    }

    public function deletePanelConditionPhoto()
    {
        $existingPhoto = $this->report->panelConditionPhotos()->where('index', $this->index)->first();
        if ($existingPhoto) {
            if ($existingPhoto->photo_path) {
                Storage::disk('public')->delete($existingPhoto->photo_path);
            }
            if ($existingPhoto->thumbnail_path) {
                Storage::disk('public')->delete($existingPhoto->thumbnail_path);
            }
            $existingPhoto->delete();
            $this->report->refresh();
        }
        $this->reset('panel_condition_photo');
        session()->flash('message', "パネル汚れ画像{$this->index}を削除しました");
    }

    public function render()
    {
        return view('livewire.upload-panel-condition-photo');
    }
}
