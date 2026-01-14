<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio - Keiber Paez</title>
    
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
    <x-navigation.simple-nav />

    <!-- Hero Section -->
    <section class="pt-20 pb-16 bg-gradient-to-br from-primary to-secondary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6">Mi Portfolio</h1>
                <p class="text-xl mb-8 max-w-3xl mx-auto">
                    Descubre mis proyectos más destacados y las tecnologías que domino. 
                    Cada proyecto representa mi pasión por crear soluciones innovadoras y funcionales.
                </p>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Mis Proyectos</h2>
                <p class="text-xl text-gray-600">Una selección de mis mejores trabajos</p>
            </div>

            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative">
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                                @if($project->featured)
                                    <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-star mr-1"></i>
                                        Destacado
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $project->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 120) }}</p>
                                
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($project->technologies_array as $tech)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ trim($tech) }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <div class="flex space-x-3">
                                        <a href="{{ route('portfolio.show', $project->id) }}" target="_blank" class="flex-1 bg-primary text-white text-center py-2 px-4 rounded-lg hover:bg-secondary transition-colors">
                                            <i class="fas fa-external-link-alt mr-2"></i>
                                            Ver Descripción
                                        </a>
                                    @if($project->url)
                                        <a href="{{ $project->url }}" target="_blank" class="flex-1 bg-primary text-white text-center py-2 px-4 rounded-lg hover:bg-secondary transition-colors">
                                            <i class="fas fa-external-link-alt mr-2"></i>
                                            Ver Proyecto
                                        </a>
                                    @endif
                                    @if($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" class="flex-1 bg-gray-800 text-white text-center py-2 px-4 rounded-lg hover:bg-gray-900 transition-colors">
                                            <i class="fab fa-github mr-2"></i>
                                            Código
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-folder-open text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay proyectos disponibles</h3>
                    <p class="text-gray-600">Pronto agregaré nuevos proyectos a mi portfolio.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Mis Habilidades</h2>
                <p class="text-xl text-gray-600">Tecnologías y herramientas que domino</p>
            </div>

            @if($skills->count() > 0)
                @php
                    $categories = $skills->groupBy('category');
                @endphp
                
                @foreach($categories as $category => $categorySkills)
                    <div class="mb-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center capitalize">
                            {{ $category === 'frontend' ? 'Frontend' : ($category === 'backend' ? 'Backend' : 'Herramientas') }}
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($categorySkills as $skill)
                                <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-4">
                                        @if($skill->icon)
                                            <i class="{{ $skill->icon }} text-3xl {{ $skill->color === 'blue' ? 'text-blue-600' : ($skill->color === 'green' ? 'text-green-600' : ($skill->color === 'red' ? 'text-red-600' : ($skill->color === 'yellow' ? 'text-yellow-600' : ($skill->color === 'purple' ? 'text-purple-600' : 'text-orange-600')))) }} mr-4"></i>
                                        @endif
                                        <div class="flex-1">
                                            <h4 class="text-lg font-semibold text-gray-900">{{ $skill->name }}</h4>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                                <div class="h-2 rounded-full {{ $skill->color === 'blue' ? 'bg-blue-600' : ($skill->color === 'green' ? 'bg-green-600' : ($skill->color === 'red' ? 'bg-red-600' : ($skill->color === 'yellow' ? 'bg-yellow-600' : ($skill->color === 'purple' ? 'bg-purple-600' : 'bg-orange-600')))) }}" style="width: {{ $skill->percentage }}%"></div>
                                            </div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-600 ml-2">{{ $skill->percentage }}%</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <i class="fas fa-code text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Habilidades en desarrollo</h3>
                    <p class="text-gray-600">Pronto agregaré información sobre mis habilidades técnicas.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">¿Tienes un Proyecto en Mente?</h2>
                <p class="text-xl text-gray-600">Hablemos sobre cómo puedo ayudarte a hacerlo realidad</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <form class="space-y-6" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                                <input type="text" id="name" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Asunto</label>
                            <input type="text" id="subject" name="subject" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('subject') border-red-500 @enderror" value="{{ old('subject') }}">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mensaje</label>
                            <textarea id="message" name="message" rows="6" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Captcha -->
                        <x-captcha />
                        
                        <button type="submit" class="w-full bg-primary text-white py-3 px-6 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        <x-captcha-script />
    </script>
</body>
</html>
