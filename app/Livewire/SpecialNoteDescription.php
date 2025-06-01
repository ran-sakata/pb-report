<?php

namespace App\Livewire;

use Livewire\Component;

class SpecialNoteDescription extends Component
{
    public $report;
    public $index;
    public $description;

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
        $this->description = old("special_note_description_{$index}", $report->specialNotes->firstWhere('index', $index)->description ?? '');
    }

    public function updatedDescription($value)
    {
        if ($value) {
            $this->report->specialNotes()->updateOrCreate(
                ['index' => $this->index],
                ['description' => $value]
            );
        }
    }

    public function render()
    {
        return view('livewire.special-note-description');
    }
}
