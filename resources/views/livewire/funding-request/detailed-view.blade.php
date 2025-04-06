<div class="container">
    <div class="max-w-6xl mx-auto p-6 flex flex-col lg:flex-row gap-6">

        <!-- Left Column -->
        <div class="flex-1">
            <h1 class="text-3xl font-bold mb-4">{{ $fundingRequest->title }}</h1>
            <img src="{{ asset('images/img1.jpg') }}" alt="Chetandeep" class="w-full rounded-md mb-4">

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="flex items-center gap-2 text-sm mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 014 14V7a4 4 0 014-4h8a4 4 0 014 4v7a4 4 0 01-1.121 2.804M15 21H9m6 0a3 3 0 11-6 0" />
                </svg>
                <p>{{ $fundingRequest->user->name }} is organising this fundraiser.</p>
            </div>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="space-y-4 text-base leading-relaxed">
                <p>{{ $fundingRequest->description }}</p>
            </div>

            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        The Budget for the Project:
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Have a look into the detailed budget for the campaign</p>
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Item
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantity
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Unit Cost
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Cost
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($budgetItems as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $item->description }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->unit_cost }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->total_cost }}
                            </td>
                        </tr>

                    @empty
                        <tr class="col-span-4 text-center">
                            No records to show
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Right Column -->
        <div class="w-full lg:w-1/3 sticky top-6 h-fit bg-gray-50 p-4 rounded-lg border shadow-sm">
            <div class="mb-4">
                <h2 class="text-2xl font-bold">$35,071 CAD raised</h2>
                <p class="text-gray-600 text-sm">$50K target · 1.4K donations</p>
                <div class="relative w-full bg-gray-200 h-3 mt-2 rounded-full">
                    <div class="absolute top-0 left-0 h-3 bg-green-500 rounded-full" style="width: 70%;"></div>
                </div>
            </div>

            <div class="space-y-2 mb-4">
                <button class="w-full bg-yellow-400 hover:bg-yellow-300 text-white font-bold py-2 rounded">Share</button>
                <button class="w-full bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 rounded">Donate now</button>
            </div>

            <p class="text-sm text-purple-700 font-semibold mb-4">184 people have just made a donation</p>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="font-semibold">Jasmeen Kaur</span>
                    <span class="text-gray-600">$25 · <a href="#" class="text-blue-500 underline">Recent donation</a></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold">Anonymous</span>
                    <span class="text-gray-600">$500 · <a href="#" class="text-blue-500 underline">Top donation</a></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold">Rupinder Singh</span>
                    <span class="text-gray-600">$100 · <a href="#" class="text-blue-500 underline">First donation</a></span>
                </div>
            </div>

            <div class="mt-4 flex gap-4">
                <button class="text-blue-600 underline text-sm">See all</button>
                <button class="text-blue-600 underline text-sm">See top</button>
            </div>
        </div>
    </div>
</div>
