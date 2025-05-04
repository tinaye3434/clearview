<div>

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Details</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">History</button>
            </li>
        </ul>
    </div>


    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
            <flux:fieldset>
                <flux:legend>Asset Details</flux:legend>

                <div class="space-y-6">

                    <form wire:submit="update">

                        <div class="grid grid-cols-2 gap-x-4 gap-y-6">

                            <flux:input wire:model="name" label="Name" description="The name of the asset" required />
                            <flux:input wire:model="description" label="Description" description="A short description of the asset, including the specs" required />
                            <flux:input wire:model="purchase_price" type="number" description="The cost of buying the asset" step="0.01" label="Purchase Price" required />
                            <flux:input wire:model="purchase_date" type="date" description="The date when the asset was acquired" label="Purchase Date" required />
                            <flux:input wire:model="assigned_to" label="Assigned To" description="The person who is possession of the asset currently" required />
                            <flux:select wire:model="supplier_id" label="Supplier" description="The name of the company from which the asset was bought from" required>
                                <option value="">-- Select --</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" @if($supplier->id == $supplier_id) selected @endif> {{ $supplier->name }} </option>
                                @endforeach
                            </flux:select>

                        </div>

                        <div class="flex mt-4">
                            <flux:spacer />

                            <flux:button type="submit" variant="primary">Save changes</flux:button>
                        </div>

                    </form>


                </div>
            </flux:fieldset>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">


            <ol class="relative border-s border-gray-200 dark:border-gray-700">
                @foreach($logs as $item)
                <li class="mb-10 ms-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $item->updated_at->format('d F Y') }}</time>
                    @if($item->action_type == 'change')
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Change of Ownership</h3>
                    @else
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Disposal</h3>
                    @endif
                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">{{ $item->comment }}</p>
                </li>
                @endforeach

            </ol>


        </div>
    </div>


</div>
