<div>

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
                    Meets Specs
                </th>
                <th scope="col" class="px-6 py-3">
                    Comment
                </th>
                <th scope="col" class="px-6 py-3">
                    Document
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($results as $item)

                <tr @if($item->is_recommend) class="bg-emerald-300 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-emerald-500 dark:hover:bg-gray-600" @else class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600" @endif >
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
                        {{ $item->recommendation_comment ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        <flux:button icon="arrow-down-tray">Download</flux:button>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <flux:button wire:click="approve({{ $item->id }})" variant="primary" size="xs" class="w-full mb-2">Pick</flux:button>
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
</div>
