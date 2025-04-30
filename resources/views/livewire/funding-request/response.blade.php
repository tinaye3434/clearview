<div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="px-6 py-3">
                </th>
                <th scope="col" class="px-6 py-3">
                    Request
                </th>
                <th scope="col" class="px-6 py-3">
                    Organisation
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
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
                        {{ mb_strimwidth($item->request->title, 0, 50, "...") }}
                    </td>
                    <td class="px-6 py-4">
                        {{ mb_strimwidth($item->donor->name, 0, 50, "...")  }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $item->amount }}
                    </td>

                    <td class="px-6 py-4 text-right">
                        <button wire:click="acknowledge({{ $item->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Acknowledge</button>
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
