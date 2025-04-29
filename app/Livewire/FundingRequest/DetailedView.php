<?php

namespace App\Livewire\FundingRequest;

use App\Models\FundingRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
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

    public function approve(FundingRequest $fundingRequest){

//        if(Auth::user()->role == 'approver')
//        {
            $fundingRequest->update([
                'is_approved' => 1,
                'approver_id' => Auth::user()->id
            ]);
//        }
        session()->flash('message', 'Post successfully updated.');
    }
}
