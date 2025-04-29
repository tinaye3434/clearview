<?php

namespace App\Livewire\FundingRequest;

use App\Models\BudgetItem;
use App\Models\FundingRequest;
use App\Traits\isBudget;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('components.layouts.app')]
class Budget extends Component
{

    use isBudget;
    public FundingRequest $fundingRequest;
    public array $items = [];
    public array $units = [];


    public function mount(FundingRequest $request)
    {

        $this->fundingRequest = $request;

        $this->units = ['Each', 'Grams', 'Meters'];

        $this->fields = [
            'id',
            'funding_request_id',
            'description',
            'unit',
            'unit_cost',
            'quantity',
            'total_cost',
            'status'
        ];

        $this->populate_array = [
            'id' => '',
            'funding_request_id' => $request->id,
            'description' => '',
            'unit' => '',
            'unit_cost' => 0,
            'quantity' => 0,
            'total_cost'  => 0,
            'status' => 'active',
        ];

        $this->setVariables();

        $this->populate();
    }

    public function render()
    {
        return view('livewire.funding-request.budget');
    }

}
