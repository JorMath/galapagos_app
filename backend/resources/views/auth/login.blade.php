<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galápagos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-12 h-12 bg-gray-900 rounded-xl flex items-center justify-center">
                    <span class="text-white font-display text-xl">G</span>
                </div>
                <span class="text-2xl font-display font-semibold text-gray-900">Galápagos</span>
            </a>
        </div>
        
        <!-- Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Bienvenido de nuevo</h2>
                <p class="mt-1 text-sm text-gray-500">Ingresa tus credenciales</p>
            </div>

            @if (session('status'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
                    <input type="email" name="email" required autofocus
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none"
                        placeholder="tu@email.com">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none"
                        placeholder="••••••••">
                </div>

                <button type="submit" 
                    class="w-full bg-gray-900 text-white py-2.5 rounded-lg font-medium hover:bg-gray-800 transition">
                    Iniciar sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>