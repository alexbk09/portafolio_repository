@extends('layouts.client')

@section('title', 'Dashboard Cliente')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Mi Dashboard</h2>
        <p class="text-gray-600">Bienvenido a tu panel de control personalizado</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-file-invoice-dollar text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Cotizaciones</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ auth()->user()->quotes()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-star text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Testimonios</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ auth()->user()->testimonials()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-bell text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Notificaciones</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ auth()->user()->unreadNotifications()->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-user text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Perfil</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ auth()->user()->clientProfile ? 'Completo' : 'Incompleto' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Acciones Rápidas</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('quotes.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-plus text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Nueva Cotización</h4>
                        <p class="text-sm text-gray-600">Solicitar un nuevo proyecto</p>
                    </div>
                </a>

                <a href="{{ route('testimonials.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <i class="fas fa-star text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Nuevo Testimonio</h4>
                        <p class="text-sm text-gray-600">Dejar tu opinión</p>
                    </div>
                </a>

                <a href="{{ route('client.profile') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <i class="fas fa-user text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900">Mi Perfil</h4>
                        <p class="text-sm text-gray-600">Actualizar información</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Notifications -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Notificaciones Recientes</h3>
            </div>
            <div class="p-6">
                @if($unreadNotifications->count() > 0)
                    <div class="space-y-4">
                        @foreach($unreadNotifications as $notification)
                            <div class="flex items-start p-4 bg-blue-50 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 rounded-full bg-{{ $notification->color }}-100 flex items-center justify-center">
                                        <i class="{{ $notification->icon }} text-{{ $notification->color }}-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <h4 class="text-sm font-medium text-gray-900">{{ $notification->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $notification->message }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('client.notifications') }}" class="text-primary hover:text-secondary text-sm font-medium">
                            Ver todas las notificaciones →
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-bell text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">No tienes notificaciones nuevas</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Quotes -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Cotizaciones Recientes</h3>
            </div>
            <div class="p-6">
                @if($quotes->count() > 0)
                    <div class="space-y-4">
                        @foreach($quotes as $quote)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $quote->project_name }}</h4>
                                        <p class="text-sm text-gray-600">{{ Str::limit($quote->description, 100) }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $quote->created_at->format('d/m/Y') }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $quote->status_color }}-100 text-{{ $quote->status_color }}-800">
                                        {{ $quote->status_text }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('client.quotes') }}" class="text-primary hover:text-secondary text-sm font-medium">
                            Ver todas las cotizaciones →
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-file-invoice-dollar text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">No tienes cotizaciones aún</p>
                        <a href="{{ route('quotes.create') }}" class="mt-2 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Crear Primera Cotización
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
