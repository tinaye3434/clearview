<?php

namespace App\Livewire\Donors\FundingRequest;

use App\Models\FundingRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.user')]
class Index extends Component
{

    public $search = '';
    public function render()
    {
        return view('livewire.donors.funding-request.index', [
            'fundingRequests' => FundingRequest::search('title', $this->search)->where('is_approved', 1)->where('is_funded', 0)->paginate(3),
        ]);
    }
}
