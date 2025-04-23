<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">

        <div class="text-right mb-3">
            <flux:modal.trigger name="add-user">
                <flux:button>Add User</flux:button>
            </flux:modal.trigger>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Organisation
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
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
                            {{ $item->organisation->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->role }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="editUser({{ $item->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                            <button wire:click="editUser({{ $item->id }})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Deactivate</button>
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
    <flux:modal name="add-user" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add User</flux:heading>
            </div>

            <form wire:submit="save">


                <flux:input class="mb-2" label="Username" placeholder="Your Username" wire:model="name" required />

                <flux:input class="mb-2" type="email" label="Email" placeholder="Your Email" wire:model="email" required />

                <flux:radio.group class="mb-5" label="Role" wire:model="role" variant="segmented" required>
                    <flux:radio value="general" label="General" icon="pencil-square" />
                    <flux:radio value="admin" label="Admin" icon="wrench" />
                    <flux:radio value="approver" label="Approver" icon="eye" />
                </flux:radio.group>

                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>

        </div>
    </flux:modal>
</section>
