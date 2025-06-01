<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;

class PanelArrayStatus extends Component
{
    public Report $report;
    public string $status;

    public function mount(Report $report)
    {
        $this->report = $report;
        $this->status = $report->panel_array_status ?? '〇';
    }

    public function setStatus($value)
    {
        $this->status = $value;
        $this->report->panel_array_status = $value;
        $this->report->save();
        $this->dispatch('panel-array-status-updated');
    }

    public function render()
    {
        return view('livewire.panel-array-status');
    }
}
