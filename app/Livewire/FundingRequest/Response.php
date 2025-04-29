<?php

namespace App\Livewire\FundingRequest;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Response extends Component
{

    public $amount;

    public function mount(){

    }

    public function render()
    {
        return view('livewire.funding-request.response');
    }

    public function donate()
    {

    }
}
