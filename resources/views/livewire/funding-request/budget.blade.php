<div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Budget for :
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    UoM
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">
                    Unit Cost
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">
                    Total Cost
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">

                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr class="bg-white dark:bg-gray-800">
                    <td class="px-6 py-4">
                        <flux:input />
                    </td>
                    <td class="px-6 py-4">
                        <flux:select wire:model="unit">
                            <flux:select.option>Each</flux:select.option>
                            <flux:select.option>Gram</flux:select.option>
                            <flux:select.option>Meter</flux:select.option>
                        </flux:select>
                    </td>
                    <td class="px-6 py-4">
                        <flux:input type="number" step="0.01" />
                    </td>
                    <td class="px-6 py-4">
                        <flux:input type="number" step="0.01" />
                    </td>
                    <td class="px-6 py-4">
                        <flux:input readonly variant="filled" />
                    </td>
                    <td class="px-6 py-4">
                        <flux:button variant="danger">Delete</flux:button>
                    </td>
                </tr>
            @endforeach

            </tbody>
{{--            <tfoot>--}}
{{--            <tr class="font-semibold text-gray-900 dark:text-white">--}}
{{--                <th scope="row" class="px-6 py-3 text-base">Total</th>--}}
{{--                <td colspan="3" class="px-6 py-3"></td>--}}
{{--                <td class="px-6 py-3">21,000</td>--}}
{{--            </tr>--}}
{{--            </tfoot>--}}
        </table>
        <div class="row">
            <button type="button" wire:click.prevent="addItem" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+ Add Another Item</button>

        </div>
        <div class="row mt-4">
            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
        </div>
    </div>

</div>
