<?php

namespace App\Livewire\Auth;

use App\Models\OrganisationDetail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth.card')]
class Tipoff extends Component
{
    public $organisation;

    public $message;

    public function render()
    {
        $organisations = OrganisationDetail::where('type', 'ngo')->get();
        return view('livewire.auth.tipoff', compact('organisations'));
    }
}
