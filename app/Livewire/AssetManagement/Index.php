<?php

namespace App\Livewire\AssetManagement;

use App\Models\Asset;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public function render()
    {
        $results = Asset::all();
        return view('livewire.asset-management.index', compact('results'));
    }
}
