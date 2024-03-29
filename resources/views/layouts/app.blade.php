<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <x-favicons></x-favicons>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

</head>

<body class="font-sans antialiased">

    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')
        <!-- Page Content -->
        <main>
            <div class="drawer lg:drawer-open">
                <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <!-- Page content here -->
                    <div class="card m-3 sm:m-4 sm:p-5
                    bg-white rounded-2xl dark:bg-gray-700
                     shadow-xl">
                        {{ $slot }}
                    </div>
                </div>
                <div class="drawer-side">
                    <label for="my-drawer-3" class="drawer-overlay"></label>
                    @if (Auth::user()->group != null)
                        @if (Auth::user()->group->type == 1)
                            <x-navbar></x-navbar>
                        @elseif (Auth::user()->group->type == 2)
                            <x-navbar-head></x-navbar-head>
                        @elseif (Auth::user()->group->type == 3)
                            <x-navbar-coach></x-navbar-coach>
                        @elseif (Auth::user()->group->type > 4)
                            <x-navbar-user></x-navbar-user>
                        @endif
                    @endif
                </div>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts

</body>

</html>
