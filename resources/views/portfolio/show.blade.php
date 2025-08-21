<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $project->title }} - Keiber Paez</title>
    
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
</head>
<body class="bg-gray-50 font-['Inter']">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary">Keiber Paez</a>
                </div>
                
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-primary transition-colors">Inicio</a>
                    <a href="{{ route('portfolio.index') }}" class="text-gray-700 hover:text-primary transition-colors">Portfolio</a>
                    <a href="{{ route('login') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Project Header -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-primary to-secondary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <a href="{{ route('portfolio.index') }}" class="inline-flex items-center text-white hover:text-gray-200 transition-colors mb-6">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver al Portfolio
                </a>
                <h1 class="text-5xl font-bold mb-6">{{ $project->title }}</h1>
                <p class="text-xl mb-8 max-w-3xl mx-auto">
                    {{ $project->description }}
                </p>
                @if($project->featured)
                    <div class="inline-flex items-center bg-yellow-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-star mr-2"></i>
                        Proyecto Destacado
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Project Details -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Project Image -->
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-96 object-cover">
                    </div>
                    
                    <!-- Project Links -->
                    <div class="flex space-x-4">
                        @if($project->url)
                            <a href="{{ $project->url }}" target="_blank" class="flex-1 bg-primary text-white text-center py-3 px-6 rounded-lg hover:bg-secondary transition-colors">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Ver Proyecto
                            </a>
                        @endif
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="flex-1 bg-gray-800 text-white text-center py-3 px-6 rounded-lg hover:bg-gray-900 transition-colors">
                                <i class="fab fa-github mr-2"></i>
                                Ver Código
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Project Information -->
                <div class="space-y-8">
                    <!-- Description -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Descripción del Proyecto</h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $project->description }}
                        </p>
                    </div>

                    <!-- Technologies -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tecnologías Utilizadas</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($project->technologies_array as $tech)
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-code mr-2"></i>
                                    {{ trim($tech) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Project Details -->
                    <div class="bg-white rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Detalles del Proyecto</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar text-primary mr-3"></i>
                                <span class="text-gray-700">Creado: {{ $project->created_at->format('d/m/Y') }}</span>
                            </div>
                            @if($project->url)
                                <div class="flex items-center">
                                    <i class="fas fa-link text-primary mr-3"></i>
                                    <a href="{{ $project->url }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition-colors">
                                        {{ $project->url }}
                                    </a>
                                </div>
                            @endif
                            @if($project->github_url)
                                <div class="flex items-center">
                                    <i class="fab fa-github text-primary mr-3"></i>
                                    <a href="{{ $project->github_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition-colors">
                                        {{ $project->github_url }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Projects -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Otros Proyectos</h2>
                <p class="text-xl text-gray-600">Explora más de mis trabajos</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $relatedProjects = \App\Models\Project::where('id', '!=', $project->id)->latest()->take(3)->get();
                @endphp
                
                @foreach($relatedProjects as $relatedProject)
                    <div class="bg-gray-50 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="relative">
                            <img src="{{ $relatedProject->image_url }}" alt="{{ $relatedProject->title }}" class="w-full h-48 object-cover">
                            @if($relatedProject->featured)
                                <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    <i class="fas fa-star mr-1"></i>
                                    Destacado
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $relatedProject->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($relatedProject->description, 100) }}</p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach(array_slice($relatedProject->technologies_array, 0, 3) as $tech)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>
                            
                            <a href="{{ route('portfolio.show', $relatedProject) }}" class="block w-full bg-primary text-white text-center py-2 px-4 rounded-lg hover:bg-secondary transition-colors">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('portfolio.index') }}" class="inline-flex items-center bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-900 transition-colors">
                    <i class="fas fa-briefcase mr-2"></i>
                    Ver Todo el Portfolio
                </a>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">¿Te Gustó Este Proyecto?</h2>
            <p class="text-xl text-gray-600 mb-8">
                Si te interesa trabajar en algo similar o tienes un proyecto en mente, 
                no dudes en contactarme. Estoy aquí para ayudarte a hacer realidad tus ideas.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="/#contact" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                    <i class="fas fa-envelope mr-2"></i>
                    Contactarme
                </a>
                <a href="{{ route('portfolio.index') }}" class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-colors">
                    <i class="fas fa-briefcase mr-2"></i>
                    Ver Más Proyectos
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-4">Keiber Paez</h3>
                <p class="text-gray-400 mb-6">Desarrollador Web Full Stack</p>
                <div class="flex justify-center space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-github text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-linkedin text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                </div>
                <p class="text-gray-500 mt-8">&copy; 2024 Keiber Paez. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
