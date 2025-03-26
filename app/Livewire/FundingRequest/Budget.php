<?php

namespace App\Livewire\FundingRequest;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user')]
class Budget extends Component
{

    public array $items = [];

    public function mount()
    {
        $this->items = [
            ['funding_request_id' => '', 'description' => '', 'unit' => '', 'unit_cost' => '', 'quantity' => 1, 'total_cost' => ''],
        ];
    }

    public function render()
    {
        return view('livewire.funding-request.budget');
    }

    public function addItem()
    {
        $this->items[] = ['funding_request_id' => '', 'description' => '', 'unit' => '', 'unit_cost' => '', 'quantity' => 1, 'total_cost' => ''];

    }
}
