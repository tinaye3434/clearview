<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Anonymous Tipoff')" :description="__('Pick the organisations and write your message below')" />

    <form wire:submit="save" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:select wire:model="organisation" placeholder="--Select--" required>
            @foreach($organisations as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </flux:select>

        <!-- Password -->
        <div class="relative">
            <flux:textarea wire:model="message" rows="2" label="Message" />
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full" >{{ __('Send') }}</flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Don\'t have anything to say?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
