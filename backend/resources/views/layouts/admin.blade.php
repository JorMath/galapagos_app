<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts - Distinctive typography -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --font-display: 'Playfair Display', serif;
                --font-body: 'DM Sans', sans-serif;
            }
            body {
                font-family: var(--font-body);
            }
            .font-display {
                font-family: var(--font-display);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-900 rounded flex items-center justify-center">
                                    <span class="text-white font-display text-sm">G</span>
                                </div>
                                <a href="{{ route('boats.index') }}" class="font-display text-xl font-semibold text-gray-900 tracking-tight">
                                    Galápagos
                                </a>
                            </div>

                            <!-- Admin Navigation Links -->
                            <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
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
            @isset($header)
                <header class="bg-white shadow-sm">
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