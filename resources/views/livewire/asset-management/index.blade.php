<div>

    <div class="text-right mb-3">
        <flux:modal.trigger name="add-asset">
            <flux:button>Add Asset</flux:button>
        </flux:modal.trigger>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Asset Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Date Purchased
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
                        {{ mb_strimwidth($item->name, 0, 50, "...")  }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->date_purchased }}
                    </td>
                    <td class="px-6 py-4">
                        @if($item->status == 'active')
                            <flux:badge color="green">{{ $item->status }}</flux:badge>
                        @else
                            <flux:badge color="red">{{ $item->status }}</flux:badge>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <flux:button variant="primary" class="w-full">View</flux:button>
                        <flux:button variant="primary" class="w-full">Edit</flux:button>
                        <flux:button variant="primary" class="w-full">Change Owner</flux:button>

{{--                        <button wire:click="editRequest({{ $item->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>--}}

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
    <flux:modal name="add-asset" class="md:w-150">

        <div>
            <flux:heading size="lg">Add Asset</flux:heading>
            <flux:text class="my-2">
                This is the standard text component for body copy and general content throughout
                your application.
            </flux:text>
        </div>

        <flux:fieldset>
            <flux:legend>Asset Details</flux:legend>

            <div class="space-y-6">
                <flux:input label="Name" class="max-w-sm" />
                <flux:input label="Description" class="max-w-sm" />

                <div class="grid grid-cols-2 gap-x-4 gap-y-6">
                    <flux:input label="Purchase Price" placeholder="San Francisco" />
                    <flux:input label="Purchase Date" placeholder="CA" />
                    <flux:input label="Assigned To" placeholder="12345" />
                    <flux:select label="Supplier">
                        <option selected>United States</option>
                        <!-- ... -->
                    </flux:select>
                </div>
            </div>
        </flux:fieldset>

        <div class="flex mt-4">
            <flux:spacer />

            <flux:button type="submit" variant="primary">Save changes</flux:button>
        </div>

    </flux:modal>
</div>
