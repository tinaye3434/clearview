<?php

namespace App\Livewire\Donors\FundingRequest;

use App\Models\Donation;
use App\Models\FundingRequest;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
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
        Donation::create([
            'funding_request_id' => $this->fundingRequest->id,
            'creator_organisation_id' => $this->fundingRequest->organisation_id,
            'donor_organisation_id' => Auth::user()->organisation_id,
            'amount' => $this->amount
        ]);

        Flux::modals()->close();

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }
}
