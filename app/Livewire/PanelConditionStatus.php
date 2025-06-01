<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;

class PanelConditionStatus extends Component
{
    public Report $report;
    public string $status;

    public function mount(Report $report)
    {
        $this->report = $report;
        $this->status = $report->panel_condition_status ?? '〇';
    }

    public function setStatus($value)
    {
        $this->status = $value;
        $this->report->panel_condition_status = $value;
        $this->report->save();
        $this->dispatch('panel-condition-status-updated');
    }

    public function render()
    {
        return view('livewire.panel-condition-status');
    }
}
