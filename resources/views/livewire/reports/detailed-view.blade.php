<div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name of Report
                </th>
                <th scope="col" class="px-6 py-3 text-right">
                    Action
                </th>

            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    Income and Expenditure
                </td>
                <td class="px-6 py-4 text-right">
                    <flux:button icon="arrow-down-tray" href="{{ route('reports.income-expenditure', $request->id) }}" variant="primary" size="xs" class="w-full mb-2">View</flux:button>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    Affidavit
                </td>
                <td class="px-6 py-4 text-right">
                    <flux:button icon="arrow-down-tray" href="{{ route('reports.income-expenditure', $request->id) }}" size="xs" class="w-full mb-2">View</flux:button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
