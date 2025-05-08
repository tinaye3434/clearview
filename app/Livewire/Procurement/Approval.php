<?php

namespace App\Livewire\Procurement;

use App\Models\BudgetItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Approval extends Component
{
    public function render()
    {
        $results = BudgetItem::where('has_recommendation', 1)
            ->where('is_purchased', 0)
            ->whereHas('fundingRequest', function($q) {
                $q->where('organisation_id', Auth::user()->organisation_id);
            })
            ->get();
        return view('livewire.procurement.approval', compact('results'));
    }
}
