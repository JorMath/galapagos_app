<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-900">
                                    Galápagos
                                </a>

                                <!-- Admin Navigation Links -->
                                <div class="hidden sm:flex sm:ms-8 sm:space-x-6">
                                    <a href="{{ route('boats.index') }}"
                                       class="{{ request()->routeIs('boats.*') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}
                                              inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                                        Barcos
                                    </a>
                                    <a href="{{ route('departures.index') }}"
                                       class="{{ request()->routeIs('departures.*') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}
                                              inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                                        Salidas
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <div class="flex items-center gap-4">
                                <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 underline">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>