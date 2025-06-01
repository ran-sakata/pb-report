<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class UploadPipePuttyPhoto extends Component
{
    use WithFileUploads;

    public Report $report;
    public int $index;

    public $pipe_putty_photo;

    protected function rules()
    {
        return [
            'pipe_putty_photo' => 'nullable|file|mimes:jpeg,png,jpg,gif,heic|max:10240',
        ];
    }

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
    }

    public function updatedPipePuttyPhoto()
    {
        $this->save();
    }

    public function save()
    {
        $this->validate();

        if ($this->pipe_putty_photo) {
            $existingPhoto = $this->report->pipePuttyPhotos()->where('index', $this->index)->first();
            if ($existingPhoto) {
                if ($existingPhoto->photo_path) {
                    Storage::disk('public')->delete($existingPhoto->photo_path);
                }
                if ($existingPhoto->thumbnail_path) {
                    Storage::disk('public')->delete($existingPhoto->thumbnail_path);
                }
                $existingPhoto->delete();
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->pipe_putty_photo, 'public');
            $this->report->pipePuttyPhotos()->updateOrCreate(
                ['report_id' => $this->report->id, 'index' => $this->index],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail'] ?? null]
            );
            $this->report->refresh();
            session()->flash('message', "配管パテ画像{$this->index}をアップロードしました");
            $this->reset('pipe_putty_photo');
        }
    }

    public function deletePipePuttyPhoto()
    {
        $existingPhoto = $this->report->pipePuttyPhotos()->where('index', $this->index)->first();
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
        $this->reset('pipe_putty_photo');
        session()->flash('message', "配管パテ画像{$this->index}を削除しました");
    }

    public function render()
    {
        return view('livewire.upload-pipe-putty-photo');
    }
}
