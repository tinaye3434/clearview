<?php

namespace App\Livewire\Auth;

use App\Models\OrganisationDetail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Integer;

#[Layout('components.layouts.auth.split')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $address = '';
    public string $phone = '';

    public string $type = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {

        $organisation = OrganisationDetail::create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone_number' => $this->phone,
            'type' => strtolower($this->type),
        ]);


//        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create([
            'name' => 'Admin',
            'email' => $this->email,
            'password' => Hash::make('password'),
            'organisation_id' => $organisation->id,
            'is_donor' => $organisation->type == 'donor' ? 1 : 0,
            'is_admin' => true,
            'role' => 'admin',
        ]))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
