<?php

namespace App\Livewire\FundingRequest;

use Livewire\Attributes\Layout;
use Livewire\Component;


class Index extends Component
{
    #[Layout('components.layouts.user')]
    public function render()
    {
        return view('livewire.funding-request.index');
    }
}
