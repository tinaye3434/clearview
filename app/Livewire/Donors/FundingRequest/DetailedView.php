<?php

namespace App\Livewire\Donors\FundingRequest;

use App\Models\FundingRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class DetailedView extends Component
{
    public $fundingRequest;
    public $budgetItems;
    public $amount;

    public function mount(FundingRequest $request)
    {
        $this->fundingRequest = $request;
        $this->budgetItems = $request->budgetItems;
    }

    public function render()
    {
        return view('livewire.donors.funding-request.detailed-view');
    }

    public function donate()
    {

    }
}
