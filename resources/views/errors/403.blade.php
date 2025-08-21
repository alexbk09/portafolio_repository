<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso Denegado - Error 403</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#1e40af',
                        accent: '#3b82f6',
                        dark: '#1f2937',
                        light: '#f8fafc'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-['Inter']">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-ban text-4xl text-red-600"></i>
                </div>
                <h1 class="text-6xl font-bold text-gray-900 mb-4">403</h1>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Acceso Denegado</h2>
                <p class="text-gray-600 mb-8">
                    No tienes permisos para acceder a esta sección. 
                    @auth
                        @if(auth()->user()->isFreelancer())
                            Como freelancer, puedes gestionar tu perfil desde tu dashboard personal.
                        @elseif(auth()->user()->isClient())
                            Como cliente, puedes explorar los freelancers disponibles.
                        @else
                            Contacta al administrador si necesitas acceso a esta sección.
                        @endif
                    @else
                        Inicia sesión para acceder a tu área personal.
                    @endauth
                </p>
            </div>

            <div class="space-y-4">
                @auth
                    @if(auth()->user()->isFreelancer())
                        <a href="{{ route('freelancer.dashboard') }}" class="block w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Ir a Mi Dashboard
                        </a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="block w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Ir al Dashboard
                        </a>
                    @else
                        <a href="{{ route('freelancers.index') }}" class="block w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            <i class="fas fa-users mr-2"></i>
                            Ver Freelancers
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </a>
                @endauth

                <a href="/" class="block w-full bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                    <i class="fas fa-home mr-2"></i>
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</body>
</html>
