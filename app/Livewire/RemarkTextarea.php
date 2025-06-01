<?php

namespace App\Livewire;

use Livewire\Component;

class RemarkTextarea extends Component
{
    public $report;
    public $remarks;

    public function mount($report)
    {
        $this->report = $report;
        $this->remarks = $report->remarks ?? '';
    }

    public function updatedRemarks($value)
    {
        $this->report->remarks = $value;
        $this->report->save();
        session()->flash('message', '備考を保存しました');
    }

    public function render()
    {
        return view('livewire.remark-textarea');
    }
}
