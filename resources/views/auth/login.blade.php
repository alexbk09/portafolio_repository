<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Keiber Paez</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
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
    @endif

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-['Inter']">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo y título -->
            <div class="text-center">
                <a href="/" class="text-3xl font-bold text-primary">Keiber Paez</a>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Iniciar Sesión
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    O
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-secondary transition-colors">
                        regístrate si no tienes una cuenta
                    </a>
                </p>
            </div>

            <!-- Formulario de login -->
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="space-y-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Correo Electrónico
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" required 
                                       class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror"
                                       placeholder="tu@email.com" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Contraseña
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required 
                                       class="appearance-none relative block w-full pl-10 pr-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror"
                                       placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Captcha -->
                        <x-captcha />

                        <!-- Botón de login -->
                        <div>
                            <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <i class="fas fa-sign-in-alt text-primary group-hover:text-white transition-colors"></i>
                                </span>
                                Iniciar Sesión
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Separador -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-gray-50 text-gray-500">O continúa con</span>
                </div>
            </div>

            <!-- Botones de redes sociales -->
            <div class="grid grid-cols-2 gap-3">
                <!-- Google -->
                <a href="{{ route('social.redirect', 'google') }}" 
                   class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    Google
                </a>

                <!-- Facebook -->
                <a href="{{ route('social.redirect', 'facebook') }}" 
                   class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                    Facebook
                </a>

                <!-- GitHub -->
                <a href="{{ route('social.redirect', 'github') }}" 
                   class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                    <i class="fab fa-github text-gray-800 mr-2"></i>
                    GitHub
                </a>

                <!-- LinkedIn -->
                <a href="{{ route('social.redirect', 'linkedin') }}" 
                   class="w-full inline-flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors">
                    <i class="fab fa-linkedin text-blue-700 mr-2"></i>
                    LinkedIn
                </a>
            </div>

            <!-- Volver al inicio -->
            <div class="text-center">
                <a href="/" class="text-sm text-gray-600 hover:text-primary transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <x-captcha-script />
</body>
</html>
        </div>
    </div>

    <x-captcha-script />
</body>
</html>
