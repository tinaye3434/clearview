<?php

namespace App\Livewire\Reports;

use App\Models\FundingRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public function render()
    {
        $results = FundingRequest::where('organisation_id', Auth::user()->organisation_id)->where('is_funded', 1)->get();
        return view('livewire.reports.index', compact('results'));
    }
}
