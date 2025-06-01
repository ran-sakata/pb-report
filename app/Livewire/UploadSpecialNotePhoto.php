<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UploadSpecialNotePhoto extends Component
{
    use WithFileUploads;

    public $report;
    public $index;
    public $photo;

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
    }

    public function updatedPhoto()
    {
        if ($this->photo) {
            $note = $this->report->specialNotes->firstWhere('index', $this->index);
            if ($note?->photo_path) {
                Storage::disk('public')->delete($note->photo_path);
            }
            if ($note?->thumbnail_path) {
                Storage::disk('public')->delete($note->thumbnail_path);
            }
            $paths = \App\Services\ImageResizer::resizeAndSave($this->photo, 'public');
            $this->report->specialNotes()->updateOrCreate(
                ['index' => $this->index],
                ['photo_path' => $paths['original'], 'thumbnail_path' => $paths['thumbnail'] ?? null]
            );
        }
    }

    public function deletePhoto()
    {
        $note = $this->report->specialNotes->firstWhere('index', $this->index);
        if ($note) {
            if ($note->photo_path) {
                Storage::disk('public')->delete($note->photo_path);
                $note->photo_path = null;
            }
            if ($note->thumbnail_path) {
                Storage::disk('public')->delete($note->thumbnail_path);
                $note->thumbnail_path = null;
            }
            $note->save();
        }
        $this->reset('photo');
    }
    

    public function render()
    {
        return view('livewire.upload-special-note-photo');
    }
}
