<?php

namespace App\Livewire\Reports;

use App\Models\FundingRequest;
use Livewire\Component;

class DetailedView extends Component
{
    public $request;

    public function mount(FundingRequest $request)
    {
        $this->request = $request;
    }

    public function render()
    {
        return view('livewire.reports.detailed-view');
    }
}
