<?php

namespace App\Livewire\Procurement;

use App\Models\BudgetItem;
use App\Models\FundingRequest;
use App\Models\Supplier;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
class Quotation extends Component
{
    use WithFileUploads;

    public $budget_item_id;
    public $suppliers;

    public $supplier_id;
    public $cost;
    public $meets_specs = 0;
    public $document;
    public $path;
    public $budget_item;

    public $to_recommend = 0;
    public $quotation_id;

    public $recommendation_comment;

    public $has_recommendation = 0;

    public function mount(BudgetItem $item)
    {
        $this->budget_item_id = $item->id;
        $this->budget_item = $item;
        $this->suppliers = Supplier::all();
    }

    public function render()
    {
        if($this->budget_item->quotations->count() >= 3){
           $this->to_recommend = 1;
        }
        $results = \App\Models\Quotation::where('budget_item_id', $this->budget_item_id)->where('organisation_id', Auth::user()->organisation_id)->get();
        return view('livewire.procurement.quotation', compact('results'));
    }

    public function save()
    {
        try {
            if($this->document){
                $this->path = $this->document->store('quotations', 'public');
            }

            \App\Models\Quotation::create([
                'budget_item_id' => $this->budget_item_id,
                'supplier_id' => $this->supplier_id,
                'cost' => $this->cost,
                'meets_specs' => $this->meets_specs,
                'path' => $this->path,
                'organisation_id' => Auth::user()->organisation_id
            ]);

            Flux::modals()->close();

            $this->js('window.location.reload()');

            LivewireAlert::title('Success')
                ->text('Operation completed successfully.')
                ->position('center')
                ->success()
                ->timer(3000)
                ->show();

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    public function recommend_modal(\App\Models\Quotation $quote)
    {
        $this->quotation_id = $quote->id;
        $this->modal('recommend-modal')->show();
    }

    public function recommend()
    {
        try{
            \App\Models\Quotation::find($this->quotation_id)->update([
                'is_recommend' => 1,
                'recommendation_comment' => $this->recommendation_comment
            ]);

            $this->budget_item->update([
                'has_recommendation' => true
            ]);

            $this->has_recommendation = 1;

            Flux::modals()->close();

            $this->js('window.location.reload()');

            LivewireAlert::title('Success')
                ->text('Operation completed successfully.')
                ->position('center')
                ->success()
                ->timer(3000)
                ->show();

            return redirect(route('procurement.index'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}
