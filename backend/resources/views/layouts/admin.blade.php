<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Galápagos') }} - Admin</title>

        <!-- Vite: CSS compiled with Tailwind -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-neutral-50/50">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="bg-white border-b border-neutral-200 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Logo & Navigation -->
                        <div class="flex items-center gap-12">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('boats.index') }}" class="font-display text-2xl font-semibold text-neutral-900 tracking-tight">
                                    Galápagos
                                </a>
                            </div>

                            <!-- Admin Navigation Links -->
                            <div class="hidden sm:flex sm:gap-1">
                                <a href="{{ route('boats.index') }}"
                                   class="{{ request()->routeIs('boats.*') ? 'bg-neutral-100 text-neutral-900' : 'text-neutral-500 hover:text-neutral-900 hover:bg-neutral-50' }}
                                          px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                                    Barcos
                                </a>
                                <a href="{{ route('departures.index') }}"
                                   class="{{ request()->routeIs('departures.*') ? 'bg-neutral-100 text-neutral-900' : 'text-neutral-500 hover:text-neutral-900 hover:bg-neutral-50' }}
                                          px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                                    Salidas
                                </a>
                            </div>
                        </div>

                        <!-- User Menu -->
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-3 pl-4 border-l border-neutral-200">
                                <div class="w-8 h-8 rounded-full bg-neutral-900 flex items-center justify-center">
                                    <span class="text-white text-xs font-medium">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div class="hidden md:block">
                                    <p class="text-sm font-medium text-neutral-900">{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="ml-2">
                                @csrf
                                <button type="submit" class="text-sm text-neutral-400 hover:text-neutral-900 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Header -->
            @hasSection('header')
                <header class="bg-white border-b border-neutral-200">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 max-w-7xl w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>

            
        </div>
    </body>
</html>