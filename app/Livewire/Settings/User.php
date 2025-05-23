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
    public $user_id;


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

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }

    public function edit(\App\Models\User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->user_id = $user->id;

        Flux::modal('edit-user')->show();
    }
    public function update()
    {
        Flux::modals()->close();

        \App\Models\User::where('id', $this->user_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => strtolower($this->role),
        ]);

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }

    public function deactivate(\App\Models\User $user)
    {
        $user->update([
            'status' => 0
        ]);

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }
    public function activate(\App\Models\User $user)
    {
        $user->update([
            'status' => 1
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
