<div>

    <div class="text-right mb-3">
        <flux:modal.trigger name="add-request">
            <flux:button>Add Request</flux:button>
        </flux:modal.trigger>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    Funded
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
                @forelse($results as $item)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <img class="rounded-full w-10 h-10" alt="logo" src="{{ asset('images/img1.jpg') }}">
                        </td>
                        <td class="px-6 py-4">
                            {{ mb_strimwidth($item->title, 0, 30, "...") }}
                        </td>
                        <td class="px-6 py-4">
                        {{ mb_strimwidth($item->description, 0, 50, "...")  }}
                    </td>
                        <td class="px-6 py-4">
                        {{ $item->target_amount }}
                    </td>
                        <td class="px-6 py-4">
                        @if($item->is_funded)
                                <flux:badge variant="pill" icon="check-badge" color="green">Yes</flux:badge>
                        @else
                                <flux:badge variant="pill" icon="exclamation-circle" color="red">No</flux:badge>
                        @endif
                    </td>
                        <td class="px-6 py-4 text-right">
                            @if($item->is_approved == 0)
                                <flux:button wire:click="editRequest({{ $item->id }})" size="xs" class="w-full mb-2">Edit</flux:button>
                                <flux:button href="{{ route('funding.budget', $item->id) }}" size="xs" variant="primary" class="w-full mb-2">Budget</flux:button>
                            @endif

                            <flux:button href="{{ route('funding.detailed-view', $item->id) }}" size="xs" variant="filled" class="w-full mb-2">View</flux:button>

{{--                        @if($item->is_approved == 0)--}}
{{--                                <button wire:click="editRequest({{ $item->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>--}}
{{--                                <a href="" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Budget</a>--}}
{{--                            @endif--}}

{{--                            <a href="{{ route('funding.detailed-view', $item->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>--}}

                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td colspan="8" class="px-6 py-4 text-center">
                            <span class="font-medium text-red-600 dark:text-red-500 hover:underline">No Data Available</span>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>


{{--    modal--}}
    <flux:modal name="add-request" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add Fund Request</flux:heading>
            </div>

            <form wire:submit="save">
                @if ($image)
                    Image Preview:
                    <img alt="image" src="{{ $image->temporaryUrl() }}">
                @endif

                <flux:input type="hidden" wire:model="organisation_id" value="{{ $organisation_id }}"/>

                <flux:input type="file" wire:model="image" class="mb-2" accept=".png, .jpg, .jpeg" label="Image"/>

                <flux:input label="Title" placeholder="Your Title" class="mb-2" wire:model="title" />

                <flux:textarea label="Description" placeholder="Your Description" wire:model="description" />

                    <div class="flex mt-5">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Save changes</flux:button>
                    </div>
            </form>

        </div>
    </flux:modal>

    <flux:modal name="edit-request" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Fund Request</flux:heading>
            </div>

            <form wire:submit="update">
                @if ($image)
                    Image Preview:
                    <img alt="image" src="{{ $image->temporaryUrl() }}">
                @endif

                <flux:input type="hidden" wire:model="organisation_id" value="{{ $organisation_id }}"/>

                <flux:input type="file" wire:model="image" class="mb-2" accept=".png, .jpg, .jpeg" label="Image"/>

                <flux:input label="Title" placeholder="Your Title" class="mb-2" wire:model="title" />

                <flux:textarea label="Description" placeholder="Your Description" wire:model="description" />

                <div class="flex mt-5">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>

        </div>
    </flux:modal>
</div>
