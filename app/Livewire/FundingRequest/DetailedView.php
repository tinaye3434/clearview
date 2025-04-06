<?php

namespace App\Livewire\FundingRequest;

use App\Models\FundingRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class DetailedView extends Component
{
    public $fundingRequest;
    public $budgetItems;

    public function mount(FundingRequest $request)
    {
        $this->fundingRequest = $request;
        $this->budgetItems = $request->budgetItems;
    }

    public function render()
    {
        return view('livewire.funding-request.detailed-view');
    }
}
