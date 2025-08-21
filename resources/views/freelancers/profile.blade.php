@extends('layouts.app')

@section('title', 'Mi Perfil - Freelancer')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Mi Perfil</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('freelancer.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Editar Perfil
                    </a>
                    <a href="{{ route('freelancer.dashboard') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver al Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="text-center mb-6">
                            <img src="{{ $profile?->photo_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80' }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                            <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-600">{{ $profile?->title ?? 'Freelancer' }}</p>
                            @if($profile?->is_available)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 mt-2">
                                    <i class="fas fa-check mr-1"></i>
                                    Disponible
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 mt-2">
                                    <i class="fas fa-times mr-1"></i>
                                    No Disponible
                                </span>
                            @endif
                        </div>

                        <!-- Contact Info -->
                        <div class="space-y-4">
                            @if($profile?->email)
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-gray-400 w-5"></i>
                                    <span class="ml-3 text-gray-700">{{ auth()->user()->email }}</span>
                                </div>
                            @endif
                            @if($profile?->phone)
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 w-5"></i>
                                    <span class="ml-3 text-gray-700">{{ $profile->phone }}</span>
                                </div>
                            @endif
                            @if($profile?->location)
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-gray-400 w-5"></i>
                                    <span class="ml-3 text-gray-700">{{ $profile->location }}</span>
                                </div>
                            @endif
                            @if($profile?->website)
                                <div class="flex items-center">
                                    <i class="fas fa-globe text-gray-400 w-5"></i>
                                    <a href="{{ $profile->website }}" target="_blank" class="ml-3 text-blue-600 hover:text-blue-800">
                                        {{ $profile->website }}
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Social Links -->
                        @if($profile?->linkedin || $profile?->github)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Enlaces Sociales</h3>
                                <div class="flex space-x-3">
                                    @if($profile->linkedin)
                                        <a href="{{ $profile->linkedin }}" target="_blank" 
                                           class="text-blue-600 hover:text-blue-800">
                                            <i class="fab fa-linkedin text-2xl"></i>
                                        </a>
                                    @endif
                                    @if($profile->github)
                                        <a href="{{ $profile->github }}" target="_blank" 
                                           class="text-gray-800 hover:text-gray-600">
                                            <i class="fab fa-github text-2xl"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Bio -->
                    @if($profile?->bio)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Sobre Mí</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $profile->bio }}</p>
                        </div>
                    @endif

                    <!-- Skills -->
                    @if($profile?->skills_array && count($profile->skills_array) > 0)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Habilidades</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($profile->skills_array as $skill)
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                        {{ trim($skill) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Services -->
                    @if($profile?->services_array && count($profile->services_array) > 0)
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Servicios Ofrecidos</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($profile->services_array as $service)
                                    <div class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-3"></i>
                                        <span class="text-gray-700">{{ trim($service) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Experience & Rate -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($profile?->experience_years)
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Experiencia</h3>
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-blue-500 text-2xl mr-4"></i>
                                    <div>
                                        <p class="text-2xl font-bold text-gray-900">{{ $profile->experience_years }}</p>
                                        <p class="text-gray-600">Años de experiencia</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($profile?->hourly_rate)
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Tarifa</h3>
                                <div class="flex items-center">
                                    <i class="fas fa-dollar-sign text-green-500 text-2xl mr-4"></i>
                                    <div>
                                        <p class="text-2xl font-bold text-gray-900">${{ $profile->hourly_rate }}</p>
                                        <p class="text-gray-600">Por hora</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Call to Action -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow p-6 text-white text-center">
                        <h3 class="text-xl font-bold mb-2">¿Tu perfil está completo?</h3>
                        <p class="mb-4">Completa tu perfil para aumentar tus oportunidades de trabajo</p>
                        <a href="{{ route('freelancer.edit') }}" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
