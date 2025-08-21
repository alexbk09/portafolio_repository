<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portfolio profesional - Desarrollador web y consultor tecnológico">
    
    <title>Keiber Paez - Desarrollador Web & Consultor</title>

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
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .skill-bar {
            transition: width 1s ease-in-out;
        }
        .portfolio-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #3b82f6;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-['Inter'] w-full">
    <!-- Navigation -->
    <x-navigation.public-nav />

    <!-- Hero Section -->
    <section id="home" class="hero-bg text-white pt-20 pb-16">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6">
                    Hola, soy <span class="text-yellow-300">Keiber Paez</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">
                    Desarrollador Web Full-Stack & Consultor Tecnológico
                </p>
                <p class="text-lg mb-12 max-w-3xl mx-auto text-blue-50">
                    Transformo ideas en soluciones digitales innovadoras. Especializado en desarrollo web, 
                    aplicaciones móviles y consultoría tecnológica para empresas.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#portfolio" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Ver Mi Trabajo
                    </a>
                    <a href="{{ route('freelancers.index') }}" class="bg-yellow-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                        <i class="fas fa-users mr-2"></i>
                        Ver Freelancers
                    </a>
                    <a href="#contact" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition-colors">
                        Contáctame
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Sobre Mí</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Apasionado desarrollador con más de 7 años de experiencia creando soluciones digitales innovadoras
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" 
                         alt="Tu Nombre" class="rounded-2xl shadow-2xl w-full">
                </div>
                
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Mi Historia</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Soy un desarrollador web apasionado por crear experiencias digitales excepcionales. 
                        Mi viaje en el mundo de la tecnología comenzó hace más de 7 años, y desde entonces 
                        he trabajado en diversos proyectos que van desde aplicaciones web hasta sistemas empresariales complejos.
                    </p>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Me especializo en tecnologías modernas como React, Laravel, Node.js y Python. 
                        Mi enfoque se centra en crear soluciones escalables, mantenibles y centradas en el usuario.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">40+</div>
                            <div class="text-gray-600">Proyectos Completados</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">7+</div>
                            <div class="text-gray-600">Años de Experiencia</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">20+</div>
                            <div class="text-gray-600">Clientes Satisfechos</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary mb-2">24/7</div>
                            <div class="text-gray-600">Soporte Técnico</div>
                        </div>
                    </div>
                    
                    <!-- Estadísticas de Freelancers -->
                    @php
                        $freelancerCount = \App\Models\User::where('role', 'freelancer')->count();
                        $availableFreelancers = \App\Models\User::where('role', 'freelancer')
                            ->whereHas('freelancerProfile', function($query) {
                                $query->where('is_available', true);
                            })->count();
                    @endphp
                    
                    <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4 text-center">Comunidad de Freelancers</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 mb-1">{{ $freelancerCount }}</div>
                                <div class="text-sm text-gray-600">Freelancers Registrados</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 mb-1">{{ $availableFreelancers }}</div>
                                <div class="text-sm text-gray-600">Disponibles</div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('freelancers.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                Ver todos los freelancers →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-gray-50">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Mi Portafolio</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Una muestra de mis proyectos más destacados y trabajos recientes
                </p>
            </div>
            
            @php
                $featuredProjects = \App\Models\Project::featured()->ordered()->take(6)->get();
            @endphp

            @if($featuredProjects->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredProjects as $project)
                        <div class="portfolio-item bg-white rounded-2xl shadow-lg overflow-hidden">
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
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 100) }}</p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(array_slice($project->technologies_array, 0, 3) as $tech)
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                                <a href="{{ route('portfolio.show', $project) }}" class="text-primary font-semibold hover:text-secondary transition-colors">
                                    Ver Proyecto →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-folder-open text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay proyectos destacados</h3>
                    <p class="text-gray-600">Pronto agregaré nuevos proyectos a mi portfolio.</p>
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('portfolio.index') }}" class="inline-flex items-center bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                    <i class="fas fa-briefcase mr-2"></i>
                    Ver Todo el Portafolio
                </a>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-white">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Mis Skills</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Tecnologías y herramientas que domino para crear soluciones excepcionales
                </p>
            </div>
            
            @php
                $skills = \App\Models\Skill::ordered()->get();
                $frontendSkills = $skills->where('category', 'frontend');
                $backendSkills = $skills->where('category', 'backend');
                $toolSkills = $skills->where('category', 'tools');
            @endphp

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Frontend Skills -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Frontend Development</h3>
                    <div class="space-y-6">
                        @foreach($frontendSkills as $skill)
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="font-medium text-gray-700">{{ $skill->name }}</span>
                                    <span class="text-gray-600">{{ $skill->percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="skill-bar {{ $skill->color === 'blue' ? 'bg-blue-600' : ($skill->color === 'green' ? 'bg-green-600' : ($skill->color === 'red' ? 'bg-red-600' : ($skill->color === 'yellow' ? 'bg-yellow-600' : ($skill->color === 'purple' ? 'bg-purple-600' : 'bg-orange-600')))) }} h-2 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Backend Skills -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Backend Development</h3>
                    <div class="space-y-6">
                        @foreach($backendSkills as $skill)
                            <div>
                                <div class="flex justify-between mb-2">
                                    <span class="font-medium text-gray-700">{{ $skill->name }}</span>
                                    <span class="text-gray-600">{{ $skill->percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="skill-bar {{ $skill->color === 'blue' ? 'bg-blue-600' : ($skill->color === 'green' ? 'bg-green-600' : ($skill->color === 'red' ? 'bg-red-600' : ($skill->color === 'yellow' ? 'bg-yellow-600' : ($skill->color === 'purple' ? 'bg-purple-600' : 'bg-orange-600')))) }} h-2 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Additional Skills -->
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Herramientas y Tecnologías</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @foreach($toolSkills as $skill)
                        <div class="text-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            @if($skill->icon)
                                <i class="{{ $skill->icon }} text-3xl {{ $skill->color === 'blue' ? 'text-blue-600' : ($skill->color === 'green' ? 'text-green-600' : ($skill->color === 'red' ? 'text-red-600' : ($skill->color === 'yellow' ? 'text-yellow-600' : ($skill->color === 'purple' ? 'text-purple-600' : 'text-orange-600')))) }} mb-2"></i>
                            @else
                                <i class="fas fa-tools text-3xl text-gray-600 mb-2"></i>
                            @endif
                            <p class="text-sm font-medium">{{ $skill->name }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

        <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-gray-50">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Lo Que Dicen Mis Clientes</h2>
                <p class="text-xl text-gray-600">Testimonios de clientes satisfechos con mi trabajo</p>
            </div>

            @php
                $testimonials = \App\Models\Testimonial::approved()->featured()->latest()->take(6)->get();
            @endphp

            @if($testimonials->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-center mb-4">
                                <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" 
                                     class="w-12 h-12 rounded-full object-cover mr-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                                    @if($testimonial->position)
                                        <p class="text-sm text-gray-600">{{ $testimonial->position }}</p>
                                    @endif
                                    @if($testimonial->company)
                                        <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-600">{{ $testimonial->rating }}/5</span>
                            </div>
                            
                            <p class="text-gray-700 italic">"{{ $testimonial->testimonial }}"</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-8">
                    <a href="{{ route('testimonials.index') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-secondary transition-colors">
                        <i class="fas fa-star mr-2"></i>
                        Ver Todos los Testimonios
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-star text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Testimonios Próximamente</h3>
                    <p class="text-gray-600">Pronto agregaré testimonios de clientes satisfechos.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white w-full">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Contáctame</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    ¿Tienes un proyecto en mente? ¡Hablemos sobre cómo puedo ayudarte a hacerlo realidad!
                </p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Envíame un Mensaje</h3>
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
                            Enviar Mensaje
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Información de Contacto</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <div class="bg-primary text-white p-3 rounded-lg">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Email</h4>
                                    <p class="text-gray-600">alexbk09@hotmail.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <div class="bg-primary text-white p-3 rounded-lg">
                                    <i class="fas fa-phone text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Teléfono</h4>
                                    <p class="text-gray-600">+56 (412) 264-9707</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <div class="bg-primary text-white p-3 rounded-lg">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Ubicación</h4>
                                    <p class="text-gray-600">caracas, Venezuela</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Sígueme</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.linkedin.com/in/keiber-paez-220934130/" class="bg-primary text-white p-3 rounded-lg hover:bg-secondary transition-colors">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                            <a href="https://github.com/alexbk09" class="bg-primary text-white p-3 rounded-lg hover:bg-secondary transition-colors">
                                <i class="fab fa-github text-xl"></i>
                            </a>
                            <a href="#" class="bg-primary text-white p-3 rounded-lg hover:bg-secondary transition-colors">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="bg-primary text-white p-3 rounded-lg hover:bg-secondary transition-colors">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Horarios de Trabajo</h3>
                        <div class="space-y-2 text-gray-600">
                            <div class="flex justify-between">
                                <span>Lunes - Viernes</span>
                                <span>9:00 AM - 6:00 PM</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Sábado</span>
                                <span>10:00 AM - 4:00 PM</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Domingo</span>
                                <span>Cerrado</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <x-footer />

    <!-- Smooth Scrolling Script -->
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

        // Animate skill bars on scroll
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.width = entry.target.style.width;
                }
            });
        }, observerOptions);

        document.querySelectorAll('.skill-bar').forEach(bar => {
            observer.observe(bar);
        });

        <x-captcha-script />
    </script>
</body>
</html>
