<?php

namespace App\Livewire\Procurement;

use App\Models\BudgetItem;
use App\Models\Ledger;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Approve extends Component
{
    public $budget_item_id;
    public $budget_item;
    public function mount(BudgetItem $item)
    {
        $this->budget_item_id = $item->id;
        $this->budget_item = $item;
    }
    public function render()
    {
        $results = \App\Models\Quotation::where('budget_item_id', $this->budget_item_id)->get();
        return view('livewire.procurement.approve', compact('results'));
    }

    public function approve(\App\Models\Quotation $quotation)
    {
        try {

            $quotation->update([
                'is_approved' => true,
            ]);

            $flagged = false;

            $variance = (float)$this->budget_item->total_cost - (float)$quotation->cost;

            $threshold = 0.25 * (float)$this->budget_item->total_cost;

            if($variance < 0 && (int)$variance > $threshold){
                $flagged = true;
            }

            $this->budget_item->update([
                'actual_cost' => $quotation->cost,
                'variance' => $variance,
                'is_purchased' => true,
                'flagged' => $flagged,
                'supplier_id' => $quotation->supplier_id,
            ]);

            Ledger::create([
                'description' => 'Purchase of '.$this->budget_item->quantity.' x '.$this->budget_item->description,
                'amount' => $quotation->cost,
                'is_income' => false,
                'request_id' => $this->budget_item->funding_request_id
                ]);

            $this->js('window.location.reload()');

            LivewireAlert::title('Success')
                ->text('Operation completed successfully.')
                ->position('center')
                ->success()
                ->timer(3000)
                ->show();

            return redirect(route('procurement.approvals'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
