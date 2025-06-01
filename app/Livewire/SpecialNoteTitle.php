<?php

namespace App\Livewire;

use Livewire\Component;

class SpecialNoteTitle extends Component
{
    public $report;
    public $index;
    public $title;

    public function mount($report, $index)
    {
        $this->report = $report;
        $this->index = $index;
        $this->title = old("special_note_title_{$index}", $report->specialNotes->firstWhere('index', $index)->title ?? '');
    }

    public function updatedTitle($value)
    {
        if ($value) {
            $this->report->specialNotes()->updateOrCreate(
                ['index' => $this->index],
                ['title' => $value]
            );
        }
    }

    public function render()
    {
        return view('livewire.special-note-title');
    }
}
