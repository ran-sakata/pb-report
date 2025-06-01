<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

class UploadPowerConverter extends Component
{
    use WithFileUploads;

    public Report $report;
    public int $index;

    #[Validate('nullable|file|mimes:jpeg,png,jpg,gif,heic|max:10240')]
    public $power_converter;

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
    }

    public function updatedPowerConverter()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->power_converter) {
            $existingPhoto = $this->report->powerConverters()->where('index', $this->index)->first();
            if ($existingPhoto && $existingPhoto->photo_path) {
                Storage::disk('public')->delete($existingPhoto->photo_path);
                if ($existingPhoto->thumbnail_path) {
                    Storage::disk('public')->delete($existingPhoto->thumbnail_path);
                }
                $existingPhoto->delete();
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->power_converter, 'public');
            $this->report->powerConverters()->updateOrCreate(
                ['report_id' => $this->report->id, 'index' => $this->index],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail'] ?? null]
            );
            session()->flash('message', "パワコン{$this->index}台目の写真をアップロードしました");
            $this->report->refresh();
        }
    }

    public function deletePowerConverter()
    {
        $existingPhoto = $this->report->powerConverters()->where('index', $this->index)->first();
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
        $this->reset('power_converter');
        session()->flash('message', "パワコン{$this->index}台目の写真を削除しました");
    }

    public function render()
    {
        return view('livewire.upload-power-converter');
    }
}
