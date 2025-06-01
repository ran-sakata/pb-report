<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Report;

class PipePuttyStatus extends Component
{
    public Report $report;
    public string $status;

    public function mount(Report $report)
    {
        $this->report = $report;
        $this->status = $report->pipe_putty_status ?? '〇';
    }

    public function setStatus($value)
    {
        $this->status = $value;
        $this->report->pipe_putty_status = $value;
        $this->report->save();
        $this->dispatch('pipe-putty-status-updated');
    }

    public function render()
    {
        return view('livewire.pipe-putty-status');
    }
}
