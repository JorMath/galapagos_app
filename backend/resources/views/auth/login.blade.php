<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galápagos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --font-display: 'Cormorant Garamond', serif;
            --font-body: 'Outfit', sans-serif;
        }
        body { 
            font-family: var(--font-body);
            background: linear-gradient(135deg, #f8f8f8 0%, #e8e8e8 100%);
        }
        .font-display { font-family: var(--font-display); }
        
        /* Fondo con patrón sutil */
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4d4d4' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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
        
        /* Botón con efecto */
        .btn-distinctive {
            background: #18181b;
            position: relative;
            overflow: hidden;
        }
        .btn-distinctive::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }
        .btn-distinctive:hover::before {
            left: 100%;
        }
        
        /* Animación de entrada */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-entry {
            animation: fadeUp 0.6s ease forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 bg-pattern">
    
    <div class="w-full max-w-sm">
        <!-- Logo con diseño distintivo -->
        <div class="text-center mb-10 animate-entry">
            <h1 class="font-display text-3xl font-medium text-gray-900 tracking-wide">Galápagos</h1>
            <p class="mt-2 text-xs text-gray-500 uppercase tracking-widest">Admin Panel</p>
        </div>
        
        <!-- Card minimal -->
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
                    class="btn-distinctive w-full py-3 text-sm font-medium text-white tracking-wide transition-all duration-300 hover:bg-gray-800">
                    ACCEDER
                </button>
            </form>
        </div>
        
        <!-- Footer minimal -->
        <div class="text-center mt-6 animate-entry delay-200">
            <p class="text-xs text-gray-400">Sistema de Gestión de Salidas</p>
        </div>
    </div>
    
    <script>
        // Efecto sutil en los inputs
        document.querySelectorAll('.input-elegant').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', '-translate-y-0.5');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', '-translate-y-0.5');
            });
        });
    </script>
</body>
</html>