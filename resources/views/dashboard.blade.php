<x-layouts.app :title="__('Dashboard')">

    <div class="p-6 max-w-7xl mx-auto">
        <!-- Top Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Total Received</p>
                    <h2 class="text-2xl text-green-500 font-bold">${{ $received }}</h2>
{{--                    <p class="text-green-500 text-sm">+55% than last week</p>--}}
                </div>
                <div class="text-2xl bg-gray-100 p-3 rounded-lg">💰</div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Total Expenditure</p>
                    <h2 class="text-2xl text-red-500 font-bold">${{ $expenditure }}</h2>
{{--                    <p class="text-green-500 text-sm">+3% than last month</p>--}}
                </div>
                <div class="text-2xl bg-gray-100 p-3 rounded-lg">📊</div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Number of Donors Engaged</p>
                    <h2 class="text-2xl font-bold">{{ $donors }}</h2>
                </div>
                <div class="text-2xl bg-gray-100 p-3 rounded-lg">👤</div>
            </div>
        </div>

        <!-- Chart Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 min-h-auto">
            <div class="bg-white rounded-xl shadow p-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Donor
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Amount
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($donations as $item)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->donor->name }}
                            </th>
                            <td class="px-6 py-4 text-right">
                                {{ $item->amount }}
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
            <div class="bg-white rounded-xl shadow p-4">


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Item
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                Variance
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($flagged as $item)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $item->description }}
                                </th>
                                <td class="px-6 py-4 text-right">
                                    {{ $item->variance }}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
{{--    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">--}}
{{--        <div class="grid auto-rows-min gap-4 md:grid-cols-3">--}}
{{--            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--                <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm text-gray-500">Today's Money</p>--}}
{{--                        <h2 class="text-2xl font-bold">$53k</h2>--}}
{{--                        <p class="text-green-500 text-sm">+55% than last week</p>--}}
{{--                    </div>--}}
{{--                    <div class="text-2xl bg-gray-100 p-3 rounded-lg">💰</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--                <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm text-gray-500">Today's Money</p>--}}
{{--                        <h2 class="text-2xl font-bold">$53k</h2>--}}
{{--                        <p class="text-green-500 text-sm">+55% than last week</p>--}}
{{--                    </div>--}}
{{--                    <div class="text-2xl bg-gray-100 p-3 rounded-lg">💰</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--                <div class="bg-white rounded-xl shadow p-4 flex justify-between items-center">--}}
{{--                    <div>--}}
{{--                        <p class="text-sm text-gray-500">Today's Money</p>--}}
{{--                        <h2 class="text-2xl font-bold">$53k</h2>--}}
{{--                        <p class="text-green-500 text-sm">+55% than last week</p>--}}
{{--                    </div>--}}
{{--                    <div class="text-2xl bg-gray-100 p-3 rounded-lg">💰</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">--}}
{{--            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />--}}
{{--        </div>--}}
{{--    </div>--}}
</x-layouts.app>
