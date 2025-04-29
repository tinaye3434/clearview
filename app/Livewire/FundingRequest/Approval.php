<?php

namespace App\Livewire\FundingRequest;

use App\Models\FundingRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Approval extends Component
{
    public $is_approver;

    public function mount(){
        $this->is_approver = Auth::user()->role == 'approver' ? true : false;
    }

    public function render()
    {
        $results = FundingRequest::where('is_approved', 0)->get();
        return view('livewire.funding-request.approval', compact('results'));
    }
}
