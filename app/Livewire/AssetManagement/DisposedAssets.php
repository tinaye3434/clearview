<?php

namespace App\Livewire\AssetManagement;

use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('components.layouts.app')]
class DisposedAssets extends Component
{
    public function render()
    {
        $results = Asset::with('log')->where('status', 'inactive')->where('organisation_id', Auth::user()->organisation_id)->get();
        return view('livewire.asset-management.disposed-assets', compact('results'));
    }
}
