<?php

namespace App\Livewire\AssetManagement;

use App\Models\Asset;
use App\Models\AssetLog;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class DetailedView extends Component
{
    public $asset;
    public $suppliers;

    public $name;
    public $description = '';
    public $purchase_price = '';
    public $purchase_date;
    public $assigned_to;
    public $supplier_id;
    public $logs;
    public function mount(Asset $asset)
    {
        $this->asset = $asset;
        $this->name = $asset->name;
        $this->description = $asset->description;
        $this->purchase_price = $asset->purchase_price;
        $this->purchase_date = $asset->purchase_date;
        $this->assigned_to = $asset->assigned_to;
        $this->supplier_id = $asset->supplier_id;
        $this->suppliers = Supplier::where('organisation_id', Auth::user()->organisation_id)->get();
        $this->logs = AssetLog::where('asset_id', $asset->id)->get();
    }

    public function render()
    {

        return view('livewire.asset-management.detailed-view');
    }

    public function update()
    {
        $this->asset->update([
            'name' => $this->name,
            'description' => $this->description,
            'purchase_price' => $this->purchase_price,
            'purchase_date' => $this->purchase_date,
            'assigned_to' => $this->assigned_to,
            'supplier_id' => $this->supplier_id,

        ]);

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }
}
