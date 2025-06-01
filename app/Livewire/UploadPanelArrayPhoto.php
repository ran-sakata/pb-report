<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class UploadPanelArrayPhoto extends Component
{
    use WithFileUploads;

    public Report $report;
    public int $index;

    public $panel_array_photo;

    protected function rules()
    {
        return [
            'panel_array_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,heic|max:10240',
        ];
    }

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
    }

    public function updatedPanelArrayPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->panel_array_photo) {
            $existingPhoto = $this->report->panelArrayPhotos()->where('index', $this->index)->first();
            if ($existingPhoto) {
                if ($existingPhoto->photo_path) {
                    Storage::disk('public')->delete($existingPhoto->photo_path);
                }
                if ($existingPhoto->thumbnail_path) {
                    Storage::disk('public')->delete($existingPhoto->thumbnail_path);
                }
                $existingPhoto->delete();
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->panel_array_photo, 'public');
            $this->report->panelArrayPhotos()->updateOrCreate(
                ['report_id' => $this->report->id, 'index' => $this->index],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail'] ?? null]
            );
            $this->report->refresh();
            session()->flash('message', "架台画像{$this->index}をアップロードしました");
            $this->reset('panel_array_photo');
        }
    }

    public function deletePanelArrayPhoto()
    {
        $existingPhoto = $this->report->panelArrayPhotos()->where('index', $this->index)->first();
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
        $this->reset('panel_array_photo');
        session()->flash('message', "架台画像{$this->index}を削除しました");
    }

    public function render()
    {
        return view('livewire.upload-panel-array-photo');
    }
}
