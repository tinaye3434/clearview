<?php

namespace App\Livewire\FundingRequest;

use App\Models\FundingRequest;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;


#[Layout('components.layouts.user')]
class Index extends Component
{
    use WithFileUploads;

    public $image;
    public $user_id;

    #[Validate('required|string')]
    public $title = '';

    #[Validate('required|string')]
    public $description = '';

    public FundingRequest $fundingRequest;

    public function mount(FundingRequest $fundingRequest)
    {
        $this->fundingRequest = $fundingRequest;
        $this->user_id = Auth::user()->id;

    }

    public function render()
    {
        $results = FundingRequest::all();
        return view('livewire.funding-request.index', compact('results'));
    }

    public function save()
    {

        $this->fundingRequest->create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => $this->user_id,
        ]);

        if ($this->image) {
            $path = $this->image->store('images', 'public');
            $this->fundingRequest->update([
                'image' => $path
            ]);
        }

        Flux::modals()->close();

    }

    public function editRequest(FundingRequest $fundingRequest)
    {
        $this->title = $fundingRequest->title;
        $this->description = $fundingRequest->description;
        $this->image = $fundingRequest->image;

        Flux::modal('add-request')->show();
    }
}
