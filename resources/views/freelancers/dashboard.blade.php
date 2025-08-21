@extends('layouts.app')

@section('title', 'Dashboard - Freelancer')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-primary">Mi Dashboard</h1>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Bienvenido, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-primary transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-4">
                <nav class="space-y-2">
                    <a href="{{ route('freelancer.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 bg-blue-50 rounded-lg">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('freelancer.profile') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-user mr-3"></i>
                        Mi Perfil
                    </a>
                    <a href="{{ route('freelancer.edit') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-edit mr-3"></i>
                        Editar Perfil
                    </a>
                    <a href="{{ route('freelancers.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-users mr-3"></i>
                        Ver Otros Freelancers
                    </a>
                    <a href="/" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-home mr-3"></i>
                        Ver Sitio
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Dashboard de Freelancer</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Profile Status -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ auth()->user()->freelancerProfile?->photo_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80' }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                                <p class="text-gray-600">{{ auth()->user()->freelancerProfile?->title ?? 'Freelancer' }}</p>
                                @if(auth()->user()->freelancerProfile?->is_available)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-1">
                                        <i class="fas fa-check mr-1"></i>
                                        Disponible
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 mt-1">
                                        <i class="fas fa-times mr-1"></i>
                                        No Disponible
                                    </span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('freelancer.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-edit mr-2"></i>
                            Editar Perfil
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-eye text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Visitas al Perfil</p>
                                <p class="text-2xl font-semibold text-gray-900">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-envelope text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Mensajes Recibidos</p>
                                <p class="text-2xl font-semibold text-gray-900">0</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-star text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Calificación</p>
                                <p class="text-2xl font-semibold text-gray-900">-</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Completion -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Completitud del Perfil</h3>
                    @php
                        $profile = auth()->user()->freelancerProfile;
                        $completedFields = 0;
                        $totalFields = 8;
                        
                        if ($profile) {
                            if ($profile->title) $completedFields++;
                            if ($profile->bio) $completedFields++;
                            if ($profile->phone) $completedFields++;
                            if ($profile->location) $completedFields++;
                            if ($profile->website) $completedFields++;
                            if ($profile->skills && count($profile->skills_array) > 0) $completedFields++;
                            if ($profile->services && count($profile->services_array) > 0) $completedFields++;
                            if ($profile->hourly_rate) $completedFields++;
                        }
                        
                        $percentage = round(($completedFields / $totalFields) * 100);
                    @endphp
                    
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Progreso</span>
                            <span class="text-sm font-medium text-gray-700">{{ $percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->title ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Título profesional</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->bio ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Biografía</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->phone ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Teléfono</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->location ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Ubicación</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->website ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Sitio web</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->skills && count($profile?->skills_array ?? []) > 0 ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Habilidades</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->services && count($profile?->services_array ?? []) > 0 ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Servicios</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas {{ $profile?->hourly_rate ? 'fa-check text-green-500' : 'fa-times text-red-500' }} mr-2"></i>
                            <span class="text-sm text-gray-700">Tarifa por hora</span>
                        </div>
                    </div>
                    
                    @if($percentage < 100)
                        <div class="mt-4">
                            <a href="{{ route('freelancer.edit') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                Completar perfil →
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Acciones Rápidas</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('freelancer.edit') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-edit text-2xl text-blue-600 mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Editar Perfil</p>
                                    <p class="text-sm text-gray-600">Actualizar información personal y profesional</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('freelancer.profile') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-eye text-2xl text-green-600 mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Ver Mi Perfil</p>
                                    <p class="text-sm text-gray-600">Ver cómo se ve tu perfil público</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('freelancers.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-users text-2xl text-purple-600 mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Ver Otros Freelancers</p>
                                    <p class="text-sm text-gray-600">Explorar la comunidad de freelancers</p>
                                </div>
                            </a>
                            
                            <a href="/" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-home text-2xl text-gray-600 mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Ver Sitio</p>
                                    <p class="text-sm text-gray-600">Visitar la página principal</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
