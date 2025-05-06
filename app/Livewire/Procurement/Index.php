<?php

namespace App\Livewire\Procurement;

use App\Models\BudgetItem;
use App\Models\FundingRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public function render()
    {
        $requests = FundingRequest::where('is_funded', 1)->where('organisation_id', Auth::user()->organisation_id)->pluck('id')->toArray();
        $results = BudgetItem::whereIn('funding_request_id', $requests)->where('is_purchased', 0)->get();
//        dd($results);
        return view('livewire.procurement.index', compact('results'));
    }
}
