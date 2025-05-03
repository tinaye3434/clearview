<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Add New Supplier')" :subheading="__('This is where all the suppliers are added')">

        <div class="text-right mb-3">
            <flux:modal.trigger name="add-supplier">
                <flux:button>Add Supplier</flux:button>
            </flux:modal.trigger>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
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
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->email }}
                        </td>
                        <td class="px-6 py-4">
                            @if($item->status == 'active')
                                <flux:badge variant="solid" icon="check-badge" size="sm" color="green">Active</flux:badge>
                            @else
                                <flux:badge variant="solid" icon="exclamation-circle" size="sm" color="rose">Inactive</flux:badge>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right">
                            <flux:button wire:click="edit({{ $item->id }})" variant="primary" size="sm" class="w-full">Edit</flux:button>
                            @if($item->status == 'active')
                                <flux:button wire:click="deactivate({{ $item->id }})" variant="danger" size="sm" class="w-full mt-2">Deactivate</flux:button>
                            @else
                                <flux:button wire:click="activate({{ $item->id }})" variant="filled" size="sm" class="w-full mt-2">Reactivate</flux:button>
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

    </x-settings.layout>


    {{--    modal--}}
    <flux:modal name="add-supplier" class="md:w-150">

        <div>
            <flux:heading size="lg">Add Supplier</flux:heading>
        </div>

        <form wire:submit="save">
            <flux:fieldset class="mt-4">

                <div class="space-y-6">
                    <flux:input wire:model="name" label="Name" class="w-full" required />
                    <flux:input wire:model="email"  type="email" label="Email" class="w-full" required />
                    <flux:input wire:model="phone"  label="Phone" class="w-full" required />
                    <flux:input wire:model="address"  label="Address" class="w-full" required />

                </div>

            </flux:fieldset>

            <div class="flex mt-4">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </form>

    </flux:modal>

    <flux:modal name="edit-supplier" class="md:w-150">

        <div>
            <flux:heading size="lg">Add Supplier</flux:heading>
        </div>

        <form wire:submit="update">
            <flux:fieldset class="mt-4">

                <div class="space-y-6">
                    <flux:input wire:model="supplier_id" type="hidden" />
                    <flux:input wire:model="name" label="Name" class="w-full" required />
                    <flux:input wire:model="email"  type="email" label="Email" class="w-full" required />
                    <flux:input wire:model="phone"  label="Phone" class="w-full" required />
                    <flux:input wire:model="address"  label="Address" class="w-full" required />

                </div>

            </flux:fieldset>

            <div class="flex mt-4">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </form>

    </flux:modal>
</section>
