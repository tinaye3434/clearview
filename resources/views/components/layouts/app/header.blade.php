<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="max-lg:hidden dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="max-lg:hidden! hidden dark:flex" />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" :href="route('user.dashboard')" :current="request()->routeIs('user.dashboard')" wire:navigate>Home</flux:navbar.item>
            <flux:navbar.item icon="document-text" :href="route('funding.index')" :current="request()->routeIs('funding.index')" wire:navigate>Funding Requests</flux:navbar.item>
            <flux:navbar.item icon="inbox" badge="12" href="#">Funding Responses</flux:navbar.item>
            <flux:navbar.item icon="calendar" href="#">Asset Management</flux:navbar.item>

            <flux:separator vertical variant="subtle" class="my-2"/>

            <flux:dropdown class="max-lg:hidden">
                <flux:navbar.item icon-trailing="chevron-down">Reports</flux:navbar.item>

                <flux:navmenu>
                    <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                    <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                    <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="mr-4">
            <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
        </flux:navbar>

        <flux:dropdown position="top" align="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />

            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                    <flux:menu.radio>Truly Delta</flux:menu.radio>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="px-2 hidden dark:flex" />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>
            <flux:navlist.item icon="document-text" href="#">Funding Requests</flux:navlist.item>
            <flux:navlist.item icon="inbox" badge="12" href="#">Funding Responses</flux:navlist.item>
            <flux:navlist.item icon="calendar" href="#">Asset Management</flux:navlist.item>

            <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">
                <flux:navlist.item href="#">Marketing site</flux:navlist.item>
                <flux:navlist.item href="#">Android app</flux:navlist.item>
                <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>

{{--    <flux:main container>--}}
{{--        <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>--}}

{{--        <flux:subheading size="lg" class="mb-6">Here's what's new today</flux:subheading>--}}

{{--        <flux:separator variant="subtle" />--}}



{{--    </flux:main>--}}

    {{ $slot }}

    @fluxScripts
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
