<?php

namespace App\Livewire\AssetManagement;

use App\Models\Asset;
use App\Models\Supplier;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $suppliers;
    public $name;
    public $description;
    public $purchase_price;
    public $purchase_date;
    public $assigned_to;
    public $supplier_id;

    public function mount()
    {
        $this->suppliers = Supplier::where('organisation_id', Auth::user()->organisation_id)->get();
    }
    public function render()
    {
        $results = Asset::all();
        return view('livewire.asset-management.index', compact('results'));
    }

    public function save()
    {
        $count = Asset::all()->count();
        try {
            Asset::create([
                'name' => $this->name,
                'description' => $this->description,
                'purchase_price' => $this->purchase_price,
                'purchase_date' => $this->purchase_date,
                'assigned_to' => $this->assigned_to,
                'organisation_id' => Auth::user()->organisation_id,
                'asset_no' => date('Y').'-'.sprintf("%04d", $count+1),
                'supplier_id' => $this->supplier_id,
            ]);

            Flux::modals()->close();

            $this->js('window.location.reload()');

            LivewireAlert::title('Success')
                ->text('Operation completed successfully.')
                ->position('center')
                ->success()
                ->timer(3000)
                ->show();

        } catch(\Exception $e) {
            dd($e->getMessage());
        }



    }
}
