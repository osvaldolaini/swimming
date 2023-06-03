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

<body class="antialiased bg-gray-800 text-gray-100">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen
    bg-dots-darker bg-center bg-gray-800 text-gray-100 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-100
                    hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm
                    focus:outline-blue-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-100 hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Entrar</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold
                        text-gray-100 hover:text-gray-600 focus:outline focus:outline-2
                        focus:rounded-sm focus:outline-blue-500">Registre-se</a>
                    @endif
                @endauth
            </div>
        @endif

        <section class="bg-gray-800 text-gray-100">
            <div class="flex flex-row">

                <div class="container mx-auto flex flex-col items-center
                px-4 pt-8 sm:py-16 text-center md:py-32 md:px-10 lg:px-14 xl:max-w-3xl">
                    <div class="block sm:hidden">
                        <x-swimming-logo></x-swimming-logo>
                    </div>

                    <h1 class="text-4xl font-bold leading-none sm:text-5xl">Sistema de acompanhamento de
                        <span class="text-blue-400">Atletas</span>
                    </h1>
                    <p class="px-8 mt-8 mb-12 text-lg">Quer montar sua equipe de revezamento sem quebrar a cabeça? Seus problemas acabaram!</p>
                    <div class="flex flex-wrap justify-center">
                        <a href="{{ route('register') }}"class="px-8 py-3 m-2 text-lg font-semibold rounded bg-blue-400 text-gray-900">Registre-se</a>
                        <a href="{{ route('dashboard') }}"class="px-8 py-3 m-2 text-lg border rounded text-gray-50 border-gray-700">Entrar</a>
                    </div>
                </div>
                <div class="hidden sm:flex container mx-auto flex flex-col items-center
                pt-0 text-center  md:px-10 xl:max-w-3xl">
                    <x-swimming-svg></x-swimming-svg>

                </div>
            </div>

        </section>

    </div>

    @livewireScripts
</body>

</html>
