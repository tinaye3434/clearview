<div>

    @if (session('status'))
        <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('status') }}
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
    <div class="relative overflow-x-auto">
        <div class="row text-right">
            <flux:button href="{{ route('funding.index') }}" icon="arrow-left">Back</flux:button>
        </div>
        <form wire:submit="save()">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Budget for :
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    UoM
                </th>
                <th scope="col" class="px-6 py-3">
                    Unit Cost
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Cost
                </th>
                <th scope="col" class="px-6 py-3 rounded-e-lg">

                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($entries as $key => $entry)
                <tr wire:key="{{ $key }}" class="bg-white dark:bg-gray-800">
                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>
                    <td class="px-6 py-4">
                        <flux:input wire:model="entries.{{$key}}.description" value="{{ $entry['description'] }}" />
                    </td>
                    <td class="px-6 py-4">
                        <flux:select wire:model="entries.{{$key}}.unit" placeholder="Select unit..." value="{{ $entry['unit'] }}">
                            @foreach($units as $unit)
                                <flux:select.option>{{ $unit }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </td>
                    <td class="px-6 py-4">
                        <flux:input type="number" wire:model.live="entries.{{$key}}.unit_cost" wire:keyup="updateTotal({{ $key }})" step="0.01" value="{{ $entry['unit_cost'] }}" />
                    </td>
                    <td class="px-6 py-4">
                        <flux:input type="number" step="0.01" wire:model.live="entries.{{$key}}.quantity" wire:keyup="updateTotal({{ $key }})" value="{{ $entry['quantity'] }}" />
                    </td>
                    <td class="px-6 py-4">
                        <flux:input variant="filled" name="entries.{{$key}}.total_cost" wire:model="entries.{{$key}}.total_cost" value="{{ $entry['total_cost'] }}" />
                    </td>
                    <td class="px-6 py-4">
                        <flux:button  wire:click="remove({{$key}})" variant="danger">Delete</flux:button>
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
                <flux:button wire:click="populate()"  >+ Add Another Item</flux:button>
            </div>
            <div class="row mt-4 text-right">
                <flux:button type="submit" >Submit</flux:button>
            </div>
        </form>
    </div>

</div>
