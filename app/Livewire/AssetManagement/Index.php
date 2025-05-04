<?php

namespace App\Livewire\AssetManagement;

use App\Models\Asset;
use App\Models\AssetLog;
use App\Models\OrganisationDetail;
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

    public $asset_id;

    public $new_owner;

    public $comment;
    public $organisation;

    public function mount()
    {
        $this->organisation = OrganisationDetail::find(Auth::user()->organisation_id);
        $this->suppliers = Supplier::where('organisation_id', Auth::user()->organisation_id)->get();
    }
    public function render()
    {
        $results = Asset::where('status', 'active')->get();
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

    public function change_modal(Asset $asset)
    {
        $this->asset_id = $asset->id;
        $this->assigned_to = $asset->assigned_to;
        Flux::modal('change-ownership')->show();
//        $this->modal('change-modal')->show();
    }

    public function dispose_modal(Asset $asset)
    {
        $this->asset_id = $asset->id;
        $this->modal('disposal-modal')->show();
    }

    public function change_ownership()
    {
        $asset = Asset::find($this->asset_id);

        AssetLog::create([
            'asset_id' => $asset->id,
            'asset_no' => $asset->asset_no,
            'action_type' => 'change',
            'new_owner' => $this->new_owner,
            'comment' => $this->comment,
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
    }

    public function dispose()
    {
        $asset = Asset::find($this->asset_id);

        AssetLog::create([
            'asset_id' => $asset->id,
            'asset_no' => $asset->asset_no,
            'action_type' => 'disposal',
            'comment' => $this->comment,
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
    }
}
