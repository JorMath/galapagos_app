<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galápagos</title>
    
    <!-- Vite: CSS compiled with Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fondo con patrón -->
    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4d4d4' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4 bg-pattern">
    
    <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="text-center mb-10 animate-entry">
            <h1 class="font-display text-3xl font-medium text-gray-900 tracking-wide">Galápagos</h1>
            <p class="mt-2 text-xs text-gray-500 uppercase tracking-widest">Admin Panel</p>
        </div>
        
        <!-- Card -->
        <div class="bg-white p-8 shadow-[0_2px_20px_rgba(0,0,0,0.04)] animate-entry delay-100">
            <h2 class="font-display text-xl text-gray-900 mb-1">Bienvenido</h2>
            <p class="text-sm text-gray-500 mb-8">Ingresa tus credenciales</p>

            @if (session('status'))
                <div class="mb-6 p-3 border border-gray-200 text-sm text-gray-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
                    <input type="email" name="email" required autofocus
                        class="input-elegant w-full px-4 py-3 text-sm placeholder-gray-400 outline-none"
                        placeholder="Correo electrónico">
                </div>

                <div class="mb-8">
                    <input type="password" name="password" required
                        class="input-elegant w-full px-4 py-3 text-sm placeholder-gray-400 outline-none"
                        placeholder="Contraseña">
                </div>

                <button type="submit" 
                    class="btn-primary w-full py-3 text-sm font-medium text-white tracking-wide transition-all duration-300 hover:bg-gray-800">
                    ACCEDER
                </button>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-6 animate-entry delay-200">
            <p class="text-xs text-gray-400">Sistema de Gestión de Salidas</p>
        </div>
    </div>
    
</body>
</html>