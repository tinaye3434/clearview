<div>
    <div class="text-right mb-3">
        <flux:modal.trigger name="add-request">
            <flux:button>Add Quotation</flux:button>
        </flux:modal.trigger>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                <th scope="col" class="px-6 py-3">
                    Supplier
                </th>
                <th scope="col" class="px-6 py-3">
                    Cost
                </th>
                <th scope="col" class="px-6 py-3">
                    Meets Specifications?
                </th>
                <th scope="col" class="px-6 py-3">
                    Quotation
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
                        {{ $item->supplier->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->cost }}
                    </td>
                    <td class="px-6 py-4">
                        @if($item->meets_specs)
                            <flux:badge variant="pill" icon="check-badge" color="green">Yes</flux:badge>
                        @else
                            <flux:badge variant="pill" icon="exclamation-circle" color="red">No</flux:badge>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <flux:button icon="arrow-down-tray">Export</flux:button>
                    </td>
                    <td class="px-6 py-4 text-right">

                        <flux:button size="xs" variant="filled" class="w-full mb-2">View</flux:button>
                        @if($to_recommend && $has_recommendation == 0)
                            <flux:button wire:click="recommend_modal({{ $item->id }})" size="xs" variant="primary" class="w-full">Recommend</flux:button>
                        @endif

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
                <flux:heading size="lg">Add Quotation</flux:heading>
            </div>

            <form wire:submit="save">


                <flux:select wire:model="supplier_id" class="mb-5" label="Supplier" required>
                    <option value="">--Select--</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                    <!-- ... -->
                </flux:select>

                <div class="grid grid-cols-2 gap-x-4 gap-y-6">

                    <flux:input wire:model="cost" class="mb-4" label="Cost" type="number" step="0.01" required />
                    <flux:radio.group wire:model="meets_specs" class="mb-4" label="Does Quotation meet specifications" variant="segmented" size="sm" required>
                        <flux:radio value="0" label="No" checked />
                        <flux:radio value="1" label="Yes" />
                    </flux:radio.group>

                </div>

                <flux:input wire:model="document" type="file" label="Document"
                            accept=".docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf" required />

                <div class="flex mt-5">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>

        </div>
    </flux:modal>

    <flux:modal name="recommend-modal" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Recommend Supplier</flux:heading>
            </div>

            <form wire:submit="recommend">

                <flux:input wire:model="recommendation_comment" class="mb-4" label="Comment" required />

                <div class="flex mt-5">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>

        </div>
    </flux:modal>
</div>
