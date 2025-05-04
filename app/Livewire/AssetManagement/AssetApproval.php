<?php

namespace App\Livewire\AssetManagement;

use App\Models\Asset;
use App\Models\AssetLog;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class AssetApproval extends Component
{
    public $asset_id;
    public $asset_no;
    public $action_type;
    public $new_owner;
    public $comment;
    public $log_id;

    public function render()
    {
        $results = AssetLog::where('organisation_id', Auth::user()->organisation_id)->where('status', 'pending')->get();
        return view('livewire.asset-management.asset-approval', compact('results'));
    }

    public function action_modal(AssetLog $log)
    {

        $this->asset_id = $log->asset_id;
        $this->asset_no = $log->asset_no;
        $this->action_type = $log->action_type == 'change' ? 'Ownership Change' : 'Disposal';
        $this->new_owner = $log->new_owner;
        $this->comment = $log->comment;
        $this->log_id = $log->id;

        Flux::modal('action-modal')->show();
    }

    public function approve()
    {
        $log = AssetLog::find($this->log_id);
        $log->update(['status' => 'approved']);

        if ($log->action_type == 'change') {
            Asset::find($this->asset_id)->update([
                'assigned_to' => $log->new_owner,
            ]);
        }

        if ($log->action_type == 'disposal') {
            Asset::find($this->asset_id)->update(['status' => 'inactive']);
        }

        Flux::modals()->close();

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }

    public function decline()
    {
        AssetLog::find($this->log_id)->update(['status' => 'declined']);

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
