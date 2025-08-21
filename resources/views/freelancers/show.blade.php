<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $freelancer->name }} - Freelancer</title>
    
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
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary">Keiber Paez</a>
                </div>
                
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="/" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Inicio</a>
                        <a href="/#portfolio" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Portfolio</a>
                        <a href="/#skills" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Skills</a>
                        <a href="/#contact" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Contacto</a>
                        <a href="{{ route('freelancers.index') }}" class="text-primary font-medium px-3 py-2 text-sm">Freelancers</a>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary transition-colors">
                                <i class="fas fa-user mr-1"></i>
                                Dashboard
                            </a>
                        @elseif(auth()->user()->isFreelancer())
                            <a href="{{ route('freelancer.dashboard') }}" class="text-gray-700 hover:text-primary transition-colors">
                                <i class="fas fa-user mr-1"></i>
                                Mi Dashboard
                            </a>
                        @else
                            <a href="#" class="text-gray-700 hover:text-primary transition-colors">
                                <i class="fas fa-user mr-1"></i>
                                Mi Cuenta
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary transition-colors">
                            <i class="fas fa-sign-in-alt mr-1"></i>
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Header -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <img src="{{ $freelancer->freelancerProfile?->photo_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80' }}" 
                     alt="{{ $freelancer->name }}" 
                     class="w-32 h-32 rounded-full mx-auto mb-6 object-cover border-4 border-white shadow-lg">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $freelancer->name }}</h1>
                <p class="text-xl md:text-2xl mb-6 text-blue-100">{{ $freelancer->freelancerProfile?->title ?? 'Freelancer' }}</p>
                @if($freelancer->freelancerProfile?->is_available)
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-green-500 text-white">
                        <i class="fas fa-check mr-2"></i>
                        Disponible para proyectos
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-500 text-white">
                        <i class="fas fa-times mr-2"></i>
                        No disponible actualmente
                    </span>
                @endif
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                        <!-- Contact Info -->
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Contacto</h3>
                        <div class="space-y-3">
                            @if($freelancer->freelancerProfile?->phone)
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 w-5"></i>
                                    <span class="ml-3 text-gray-700">{{ $freelancer->freelancerProfile->phone }}</span>
                                </div>
                            @endif
                            @if($freelancer->freelancerProfile?->location)
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-gray-400 w-5"></i>
                                    <span class="ml-3 text-gray-700">{{ $freelancer->freelancerProfile->location }}</span>
                                </div>
                            @endif
                            @if($freelancer->freelancerProfile?->website)
                                <div class="flex items-center">
                                    <i class="fas fa-globe text-gray-400 w-5"></i>
                                    <a href="{{ $freelancer->freelancerProfile->website }}" target="_blank" class="ml-3 text-blue-600 hover:text-blue-800">
                                        {{ $freelancer->freelancerProfile->website }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Social Links -->
                        @if($freelancer->freelancerProfile?->linkedin || $freelancer->freelancerProfile?->github)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Enlaces Sociales</h3>
                                <div class="flex space-x-3">
                                    @if($freelancer->freelancerProfile->linkedin)
                                        <a href="{{ $freelancer->freelancerProfile->linkedin }}" target="_blank" 
                                           class="text-blue-600 hover:text-blue-800">
                                            <i class="fab fa-linkedin text-2xl"></i>
                                        </a>
                                    @endif
                                    @if($freelancer->freelancerProfile->github)
                                        <a href="{{ $freelancer->freelancerProfile->github }}" target="_blank" 
                                           class="text-gray-800 hover:text-gray-600">
                                            <i class="fab fa-github text-2xl"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Professional Info -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            @if($freelancer->freelancerProfile?->hourly_rate)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Tarifa por Hora</h4>
                                    <p class="text-2xl font-bold text-gray-900">${{ $freelancer->freelancerProfile->hourly_rate }}</p>
                                </div>
                            @endif
                            @if($freelancer->freelancerProfile?->experience_years)
                                <div class="mb-4">
                                    <h4 class="text-sm font-medium text-gray-500">Experiencia</h4>
                                    <p class="text-lg font-semibold text-gray-900">{{ $freelancer->freelancerProfile->experience_years }} años</p>
                                </div>
                            @endif
                        </div>

                        <!-- Contact Button -->
                        <div class="mt-6">
                            <a href="mailto:{{ $freelancer->email }}?subject=Interesado en tus servicios" 
                               class="w-full bg-primary text-white text-center py-3 rounded-lg hover:bg-secondary transition-colors block">
                                <i class="fas fa-envelope mr-2"></i>
                                Contactar
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Bio -->
                    @if($freelancer->freelancerProfile?->bio)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Sobre {{ $freelancer->name }}</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $freelancer->freelancerProfile->bio }}</p>
                        </div>
                    @endif

                    <!-- Skills -->
                    @if($freelancer->freelancerProfile?->skills_array && count($freelancer->freelancerProfile->skills_array) > 0)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Habilidades</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($freelancer->freelancerProfile->skills_array as $skill)
                                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">
                                        {{ trim($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Services -->
                    @if($freelancer->freelancerProfile?->services_array && count($freelancer->freelancerProfile->services_array) > 0)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Servicios Ofrecidos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($freelancer->freelancerProfile->services_array as $service)
                                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                        <i class="fas fa-check text-green-500 mr-3"></i>
                                        <span class="text-gray-700 font-medium">{{ trim($service) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Call to Action -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow p-8 text-white text-center">
                        <h3 class="text-2xl font-bold mb-4">¿Te interesa trabajar con {{ $freelancer->name }}?</h3>
                        <p class="text-lg mb-6 text-blue-100">
                            Contacta directamente para discutir tu proyecto y obtener una cotización personalizada.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="mailto:{{ $freelancer->email }}?subject=Interesado en tus servicios" 
                               class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                                <i class="fas fa-envelope mr-2"></i>
                                Enviar Mensaje
                            </a>
                            <a href="{{ route('freelancers.index') }}" 
                               class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                                <i class="fas fa-users mr-2"></i>
                                Ver Más Freelancers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-600">
                    © 2024 Keiber Paez. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
