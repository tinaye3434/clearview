<?php

namespace App\Livewire\FundingRequest;

use App\Models\FundingRequest;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;


#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithFileUploads;

    public $image;
    public $organisation_id;

    #[Validate('required|string')]
    public $title = '';

    #[Validate('required|string')]
    public $description = '';

    public FundingRequest $fundingRequest;

    public function mount(FundingRequest $fundingRequest)
    {
        $this->fundingRequest = $fundingRequest;
        $this->organisation_id = Auth::user()->organisation_id;

    }

    public function render()
    {
        $results = FundingRequest::where('organisation_id', $this->organisation_id)->get();
        return view('livewire.funding-request.index', compact('results'));
    }

    public function save()
    {

        $this->fundingRequest->create([
            'title' => $this->title,
            'description' => $this->description,
            'organisation_id' => $this->organisation_id,
        ]);

        if ($this->image) {
            $path = $this->image->store('images', 'public');
            $this->fundingRequest->update([
                'image' => $path
            ]);
        }

        Flux::modals()->close();

        LivewireAlert::title('Success')
            ->text('Operation completed successfully.')
            ->position('center')
            ->success()
            ->timer(3000)
            ->show();

    }

    public function editRequest(FundingRequest $fundingRequest)
    {
        $this->title = $fundingRequest->title;
        $this->description = $fundingRequest->description;
        $this->image = $fundingRequest->image;

        Flux::modal('add-request')->show();
    }
}
