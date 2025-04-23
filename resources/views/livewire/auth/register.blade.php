<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your organisations details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-2">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            badge="required"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            badge="required"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="address"
            :label="__('Physical Address')"
            badge="required"
            type="text"
            required
            autocomplete="physical address"
            :placeholder="__('Physical Address')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="phone"
            :label="__('Phone Number')"
            badge="required"
            type="number"
            required
            autocomplete="contact"
            :placeholder="__('Contact')"
        />

        <flux:select
            wire:model="type"
            :label="__('Type/ Nature of Organisation')"
            badge="required"
            placeholder="--Select one--">
            <flux:select.option>DONOR</flux:select.option>
            <flux:select.option>NGO</flux:select.option>
        </flux:select>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
