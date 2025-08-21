<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Freelancers - Keiber Paez</title>
    
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Encuentra el Freelancer Perfecto
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Conectamos talento con oportunidades
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>
                    Únete como Freelancer
                </a>
                <a href="{{ route('register') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition-colors">
                    <i class="fas fa-briefcase mr-2"></i>
                    Contrata Servicios
                </a>
            </div>
        </div>
    </section>

    <!-- Freelancers List -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Freelancers Disponibles</h2>
                <p class="text-lg text-gray-600">
                    Encuentra profesionales talentosos para tu próximo proyecto
                </p>
            </div>

            @if($freelancers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($freelancers as $freelancer)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative">
                                <img src="{{ $freelancer->freelancerProfile?->photo_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80' }}" 
                                     alt="{{ $freelancer->name }}" class="w-full h-48 object-cover">
                                @if($freelancer->freelancerProfile?->is_available)
                                    <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-check mr-1"></i>
                                        Disponible
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">{{ $freelancer->name }}</h3>
                                        <p class="text-gray-600">{{ $freelancer->freelancerProfile?->title ?? 'Freelancer' }}</p>
                                    </div>
                                </div>
                                
                                @if($freelancer->freelancerProfile?->bio)
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {{ Str::limit($freelancer->freelancerProfile->bio, 120) }}
                                    </p>
                                @endif
                                
                                @if($freelancer->freelancerProfile?->skills_array)
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(array_slice($freelancer->freelancerProfile->skills_array, 0, 3) as $skill)
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                    {{ trim($skill) }}
                                                </span>
                                            @endforeach
                                            @if(count($freelancer->freelancerProfile->skills_array) > 3)
                                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                                                    +{{ count($freelancer->freelancerProfile->skills_array) - 3 }} más
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="flex items-center justify-between mb-4">
                                    @if($freelancer->freelancerProfile?->hourly_rate)
                                        <div class="text-sm text-gray-600">
                                            <i class="fas fa-dollar-sign mr-1"></i>
                                            ${{ $freelancer->freelancerProfile->hourly_rate }}/hora
                                        </div>
                                    @endif
                                    @if($freelancer->freelancerProfile?->experience_years)
                                        <div class="text-sm text-gray-600">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $freelancer->freelancerProfile->experience_years }} años
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('freelancers.show', $freelancer) }}" 
                                       class="flex-1 bg-primary text-white text-center py-2 rounded-lg hover:bg-secondary transition-colors">
                                        Ver Perfil
                                    </a>
                                    @if($freelancer->freelancerProfile?->website)
                                        <a href="{{ $freelancer->freelancerProfile->website }}" target="_blank"
                                           class="bg-gray-100 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-12">
                    {{ $freelancers->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-users text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay freelancers disponibles</h3>
                    <p class="text-gray-600 mb-6">Sé el primero en registrarte como freelancer</p>
                    <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-secondary transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>
                        Registrarse como Freelancer
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">¿Eres un Freelancer?</h2>
            <p class="text-xl text-gray-300 mb-8">
                Únete a nuestra comunidad y encuentra proyectos increíbles
            </p>
            <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                <i class="fas fa-rocket mr-2"></i>
                Comenzar Ahora
            </a>
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
