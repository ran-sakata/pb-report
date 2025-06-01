<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;

class PowerConverterStatus extends Component
{
    public Report $report;
    public string $status;

    public function mount(Report $report)
    {
        $this->report = $report;
        $this->status = $report->power_converter_status ?? '〇';
    }

    public function setStatus($value)
    {
        $this->status = $value;
        $this->report->power_converter_status = $value;
        $this->report->save();
        $this->dispatch('status-updated');
    }

    public function render()
    {
        return view('livewire.power-converter-status');
    }
}
