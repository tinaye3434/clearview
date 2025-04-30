<?php

namespace App\Livewire\Settings;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Integer;

class User extends Component
{
    public $name;
    public $email;
    public $role;

    public function mount()
    {

    }

    public function render()
    {
        $results = \App\Models\User::where('organisation_id', Auth::user()->organisation_id)->get();
        return view('livewire.settings.user', compact('results'));
    }

    public function save()
    {
        \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => strtolower($this->role),
            'password' => Hash::make('password'),
            'organisation_id' => Auth::user()->organisation_id,
            'is_donor' => Auth::user()->is_donor,
            'is_admin' => strtolower($this->role) == 'admin' ? true : false,
        ]);

        Flux::modals()->close();

//        return redirect()->route('settings.user');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }
}
