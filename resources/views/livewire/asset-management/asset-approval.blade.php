<div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Asset Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Comment
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
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
                        {{ $item->asset_no }}
                    </td>
                    <td class="px-6 py-4">
                        {{ strtoupper($item->action_type) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ mb_strimwidth($item->comment, 0, 50, "...") }}
                    </td>
                    <td class="px-6 py-4">
                        <flux:badge variant="solid" icon="clock" size="sm" color="cyan">{{ $item->status }}</flux:badge>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <flux:button href="{{ route('asset.view', $item->id) }}" variant="primary" size="xs" class="w-full">View</flux:button>
                        <flux:button wire:click="action_modal({{ $item->id }})" variant="filled" size="xs" class="w-full mt-2">Action</flux:button>
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


    {{--  modals  --}}
    <flux:modal name="action-modal" class="md:w-120">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Action Request</flux:heading>
            </div>
            <flux:input wire:model="asset_no" label="Asset Number" readonly variant="filled" />
            <flux:input wire:model="action_type" label="Type" readonly variant="filled" />
            @if($new_owner)
                <flux:input wire:model="new_owner" label="New Owner" readonly variant="filled" />
            @endif
            <flux:input wire:model="comment" label="Comment" readonly variant="filled" />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:button wire:click="approve" variant="primary">Approve</flux:button>
                <flux:button wire:click="decline" variant="danger">Decline</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
