@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Dashboard</h2>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <i class="fas fa-briefcase text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Proyectos</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Project::count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-envelope text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Mensajes</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Contact::count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-exclamation-circle text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Sin Leer</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Contact::unread()->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Messages -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Mensajes Recientes</h3>
                    </div>
                    <div class="p-6">
                        @php
                            $recentMessages = \App\Models\Contact::latest()->take(5)->get();
                        @endphp
                        
                        @if($recentMessages->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentMessages as $message)
                                    <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg {{ $message->isRead() ? 'bg-gray-50' : 'bg-blue-50' }}">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">{{ $message->name }}</p>
                                                    <p class="text-sm text-gray-600">{{ $message->email }}</p>
                                                    <p class="text-sm text-gray-500">{{ $message->subject }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                                            @if(!$message->isRead())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Nuevo
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-6 text-center">
                                <a href="{{ route('admin.contact') }}" class="text-primary hover:text-secondary transition-colors">
                                    Ver todos los mensajes →
                                </a>
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No hay mensajes recientes</p>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="mt-8 bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Acciones Rápidas</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('admin.portfolio') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-plus-circle text-2xl text-primary mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Agregar Proyecto</p>
                                    <p class="text-sm text-gray-600">Crear un nuevo proyecto para el portfolio</p>
                                </div>
                            </a>
                            
                            <a href="{{ route('admin.contact') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-envelope-open text-2xl text-green-600 mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Ver Mensajes</p>
                                    <p class="text-sm text-gray-600">Revisar mensajes de contacto</p>
                                </div>
                            </a>
                            
                            <a href="/" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-eye text-2xl text-blue-600 mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Ver Sitio</p>
                                    <p class="text-sm text-gray-600">Ver cómo se ve el sitio público</p>
                                </div>
                            </a>
                            
                            <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-cog text-2xl text-gray-600 mr-4"></i>
                                <div>
                                    <p class="font-medium text-gray-900">Configuración</p>
                                    <p class="text-sm text-gray-600">Configurar el sitio web</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
