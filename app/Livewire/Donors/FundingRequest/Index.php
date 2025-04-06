<?php

namespace App\Livewire\Donors\FundingRequest;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class Index extends Component
{

    public function render()
    {
        return view('livewire.donors.funding-request.index');
    }
}
