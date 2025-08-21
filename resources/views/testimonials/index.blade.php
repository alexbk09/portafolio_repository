@extends('layouts.app')

@section('title', 'Testimonios - Keiber Paez')

@section('content')
    <!-- Navigation -->
    <x-navigation.internal-nav />
    
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Testimonios', 'icon' => 'fas fa-star']
    ]" />
    
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-secondary text-white py-20">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Testimonios de Clientes</h1>
                <p class="text-xl opacity-90 max-w-3xl mx-auto">
                    Descubre lo que dicen mis clientes sobre mi trabajo y experiencia profesional
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="text-center mb-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="text-3xl font-bold text-primary mb-2">{{ $totalTestimonials }}</div>
                        <div class="text-gray-600">Total de Testimonios</div>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="text-3xl font-bold text-primary mb-2">{{ number_format($averageRating, 1) }}</div>
                        <div class="text-gray-600">Calificación Promedio</div>
                    </div>
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="text-3xl font-bold text-primary mb-2">{{ $featuredCount }}</div>
                        <div class="text-gray-600">Testimonios Destacados</div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="flex justify-center mb-8">
                <div class="flex space-x-4">
                    <a href="{{ route('testimonials.index') }}" 
                       class="px-4 py-2 rounded-lg {{ request('filter') === null ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} transition-colors">
                        Todos
                    </a>
                    <a href="{{ route('testimonials.index', ['filter' => 'featured']) }}" 
                       class="px-4 py-2 rounded-lg {{ request('filter') === 'featured' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} transition-colors">
                        Destacados
                    </a>
                    <a href="{{ route('testimonials.index', ['filter' => 'recent']) }}" 
                       class="px-4 py-2 rounded-lg {{ request('filter') === 'recent' ? 'bg-primary text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} transition-colors">
                        Más Recientes
                    </a>
                </div>
            </div>

            @if($testimonials->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow">
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
                                @if($testimonial->featured)
                                    <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-star mr-1"></i>
                                        Destacado
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-gray-700 italic mb-4">"{{ $testimonial->testimonial }}"</p>
                            
                            <div class="text-xs text-gray-500">
                                {{ $testimonial->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-12">
                    {{ $testimonials->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-star text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay testimonios disponibles</h3>
                    <p class="text-gray-600">Pronto agregaré testimonios de clientes satisfechos.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="mx-56 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">¿Trabajaste conmigo?</h2>
                <p class="text-xl text-gray-600 mb-8">Comparte tu experiencia y ayuda a otros a conocerme mejor</p>
                @auth
                    @if(auth()->user()->isClient())
                        <a href="{{ route('testimonials.create') }}" class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition-colors">
                            <i class="fas fa-star mr-2"></i>
                            Dejar Testimonio
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Iniciar Sesión para Dejar Testimonio
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition-colors">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión para Dejar Testimonio
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-footer />

    <!-- Scripts -->
    <x-captcha-script />
@endsection
