<?php

namespace App\Livewire\Donors\FundingRequest;

use App\Models\FundingRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.user')]
class Index extends Component
{

    public function render()
    {
        return view('livewire.donors.funding-request.index', [
            'fundingRequests' => FundingRequest::where('is_approved', 1)->paginate(3),
        ]);
    }
}
