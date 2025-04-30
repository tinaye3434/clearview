<?php

namespace App\Livewire\FundingRequest;

use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Response extends Component
{

    public function mount(){

    }

    public function render()
    {
        $results = Donation::where('creator_organisation_id', Auth::user()->organisation_id)->where('status', 'pending')->get();
        return view('livewire.funding-request.response', compact('results'));
    }

    public function acknowledge(Donation $donation)
    {
        $donation->update([
            'status' => 'accepted'
        ]);

        $total_donated = $donation->request->amount + $donation->amount;

        $donation->request->update([
            'amount' => $total_donated
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
