<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class UploadPowerConverterPhoto extends Component
{
    use WithFileUploads;

    public Report $report;
    public int $index;

    public $power_converter_photo;

    protected function rules()
    {
        return [
            'power_converter_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,heic|max:10240',
        ];
    }

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
    }

    public function updatedPowerConverterPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->power_converter_photo) {
            $existingPhoto = $this->report->powerConverterPhotos()->where('index', $this->index)->first();
            if ($existingPhoto) {
                if ($existingPhoto->photo_path) {
                    Storage::disk('public')->delete($existingPhoto->photo_path);
                }
                if ($existingPhoto->thumbnail_path) {
                    Storage::disk('public')->delete($existingPhoto->thumbnail_path);
                }
                $existingPhoto->delete();
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->power_converter_photo, 'public');
            $this->report->powerConverterPhotos()->updateOrCreate(
                ['report_id' => $this->report->id, 'index' => $this->index],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail'] ?? null]
            );
            $this->report->refresh();
            session()->flash('message', "パワコン全景{$this->index}をアップロードしました");
            $this->reset('power_converter_photo');
        }
    }

    public function deletePowerConverterPhoto()
    {
        $existingPhoto = $this->report->powerConverterPhotos()->where('index', $this->index)->first();
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
        $this->reset('power_converter_photo');
        session()->flash('message', "パワコン全景{$this->index}を削除しました");
    }

    public function render()
    {
        return view('livewire.upload-power-converter-photo');
    }
}
