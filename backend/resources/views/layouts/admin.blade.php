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
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">

        <!-- Tailwind CDN for quick testing -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            display: ['"Cormorant Garamond"', 'serif'],
                            body: ['Outfit', 'sans-serif'],
                        },
                        colors: {
                            gray: {
                                50: '#fafafa',
                                100: '#f5f5f5',
                                200: '#e5e5e5',
                                300: '#d4d4d4',
                                400: '#a3a3a3',
                                500: '#737373',
                                600: '#525252',
                                700: '#404040',
                                800: '#262626',
                                900: '#18181b',
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            :root {
                --font-display: 'Cormorant Garamond', serif;
                --font-body: 'Outfit', sans-serif;
            }
            body {
                font-family: var(--font-body);
            }
            .font-display {
                font-family: var(--font-display);
            }
            
            /* Fondo con patrón sutil */
            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4d4d4' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
            
            /* Input con estilo distintivo */
            .input-elegant {
                background: transparent;
                border: 1px solid #d4d4d4;
                transition: all 0.3s ease;
            }
            .input-elegant:focus {
                border-color: #18181b;
                box-shadow: 0 0 0 3px rgba(24, 24, 27, 0.05);
            }
            
            /* Botón primario distintivo */
            .btn-primary {
                background: #18181b;
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }
            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
                transition: left 0.5s ease;
            }
            .btn-primary:hover::before {
                left: 100%;
            }
            .btn-primary:hover {
                background: #262626;
            }
            
            /* Botón secundario distintivo */
            .btn-secondary {
                background: transparent;
                border: 1px solid #d4d4d4;
                color: #525252;
                transition: all 0.3s ease;
            }
            .btn-secondary:hover {
                border-color: #18181b;
                color: #18181b;
                background: #fafafa;
            }
            
            /* Card con sombra sutil */
            .card-elegant {
                background: white;
                border: 1px solid #e5e5e5;
                box-shadow: 0 2px 20px rgba(0,0,0,0.03);
            }
            
            /* Navlink distintivo */
            .nav-link {
                position: relative;
                padding: 0.5rem 0;
                color: #737373;
                font-weight: 400;
                transition: color 0.2s ease;
            }
            .nav-link::after {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 1px;
                background: #18181b;
                transition: width 0.3s ease;
            }
            .nav-link:hover {
                color: #18181b;
            }
            .nav-link:hover::after {
                width: 100%;
            }
            .nav-link.active {
                color: #18181b;
                font-weight: 500;
            }
            .nav-link.active::after {
                width: 100%;
            }
            
            /* Tabla distintiva */
            .table-elegant {
                width: 100%;
                border-collapse: collapse;
            }
            .table-elegant thead th {
                background: #fafafa;
                border-bottom: 1px solid #e5e5e5;
                padding: 1rem 1.5rem;
                font-size: 0.75rem;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                color: #737373;
                text-align: left;
            }
            .table-elegant tbody td {
                padding: 1rem 1.5rem;
                border-bottom: 1px solid #f5f5f5;
                color: #525252;
                font-size: 0.875rem;
            }
            .table-elegant tbody tr {
                transition: background 0.2s ease;
            }
            .table-elegant tbody tr:hover {
                background: #fafafa;
            }
            
            /* Badge distintivo */
            .badge-elegant {
                display: inline-flex;
                align-items: center;
                padding: 0.25rem 0.75rem;
                font-size: 0.75rem;
                font-weight: 500;
                letter-spacing: 0.02em;
            }
            .badge-active {
                background: #f5f5f5;
                color: #404040;
                border: 1px solid #e5e5e5;
            }
            .badge-inactive {
                background: #fafafa;
                color: #a3a3a3;
                border: 1px solid #e5e5e5;
            }
            .badge-itinerary {
                background: #18181b;
                color: white;
            }
            
            /* Dropzone distintivo */
            .dropzone-elegant {
                border: 1px dashed #d4d4d4;
                background: #fafafa;
                transition: all 0.3s ease;
            }
            .dropzone-elegant:hover {
                border-color: #18181b;
                background: #f5f5f5;
            }
            .dropzone-elegant.dragover {
                border-color: #18181b;
                background: #f5f5f5;
            }
            
            /* Animación de entrada */
            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-entry {
                animation: fadeUp 0.4s ease forwards;
            }
            .delay-100 { animation-delay: 0.1s; }
            .delay-200 { animation-delay: 0.2s; }
        </style>
    </head>
    <body class="font-body antialiased bg-pattern min-h-screen">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center gap-12">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-900 flex items-center justify-center">
                                    <span class="text-white font-display text-sm">G</span>
                                </div>
                                <a href="{{ route('boats.index') }}" class="font-display text-xl font-medium text-gray-900 tracking-wide">
                                    Galápagos
                                </a>
                            </div>

                            <!-- Admin Navigation Links -->
                            <div class="hidden sm:flex sm:gap-8">
                                <a href="{{ route('boats.index') }}"
                                   class="nav-link {{ request()->routeIs('boats.*') ? 'active' : '' }}">
                                    Barcos
                                </a>
                                <a href="{{ route('departures.index') }}"
                                   class="nav-link {{ request()->routeIs('departures.*') ? 'active' : '' }}">
                                    Salidas
                                </a>
                            </div>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="flex items-center gap-6">
                            <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
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
                <header class="bg-white border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1 max-w-7xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>