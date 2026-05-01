<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Vite: CSS compiled with Tailwind -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center gap-12">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('boats.index') }}" class="font-display text-xl font-medium text-gray-900 tracking-wide">
                                    Galápagos
                                </a>
                            </div>

                            <!-- Admin Navigation Links -->
                            <div class="hidden sm:flex sm:gap-8">
                                <a href="{{ route('boats.index') }}"
                                   class="{{ request()->routeIs('boats.*') ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}
                                          inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200">
                                    Barcos
                                </a>
                                <a href="{{ route('departures.index') }}"
                                   class="{{ request()->routeIs('departures.*') ? 'border-gray-900 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}
                                          inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all duration-200">
                                    Salidas
                                </a>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-600">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-gray-400 hover:text-gray-900 transition-colors">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @hasSection('header')
                <header class="bg-white shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>