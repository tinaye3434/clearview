<?php

namespace App\Livewire\Settings;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Supplier extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $supplier_id;


    public function render()
    {
        $results = \App\Models\Supplier::where('organisation_id', Auth::user()->organisation_id)->get();
        return view('livewire.settings.supplier', compact('results'));
    }

    public function save()
    {
        \App\Models\Supplier::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
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

    public function edit(\App\Models\Supplier $supplier)
    {
        $this->name = $supplier->name;
        $this->email = $supplier->email;
        $this->address = $supplier->address;
        $this->phone = $supplier->phone;
        $this->supplier_id = $supplier->id;

        Flux::modal('edit-supplier')->show();
    }

    public function update()
    {
        Flux::modals()->close();

        \App\Models\Supplier::where('id', $this->supplier_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }

    public function deactivate(\App\Models\Supplier $supplier)
    {
        $supplier->update([
            'status' => 'inactive'
        ]);

        $this->js('window.location.reload()');

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();
    }

    public function activate(\App\Models\Supplier $supplier)
    {
        $supplier->update([
            'status' => 'active'
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
