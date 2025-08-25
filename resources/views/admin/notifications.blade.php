@extends('layouts.admin')

@section('title', 'Gestión de Notificaciones')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Gestión de Notificaciones</h2>
        <p class="text-gray-600">Administra las notificaciones del sistema</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-bell text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalNotifications }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Sin Leer</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $unreadNotifications }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Leídas</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $readNotifications }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Usuarios</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $usersWithNotifications }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Acciones</h3>
                <div class="flex space-x-3">
                    @if($unreadNotifications > 0)
                        <form method="POST" action="{{ route('admin.notifications.mark-all-read') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                <i class="fas fa-check-double mr-2"></i>
                                Marcar Todas como Leídas
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.notifications.clear-all') }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar todas las notificaciones?')">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
                            <i class="fas fa-trash mr-2"></i>
                            Limpiar Todas
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Filtros</h3>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.notifications') }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Todas
                    </a>
                    <a href="{{ route('admin.notifications', ['filter' => 'unread']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'unread' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Sin Leer
                    </a>
                    <a href="{{ route('admin.notifications', ['filter' => 'read']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'read' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Leídas
                    </a>
                    <a href="{{ route('admin.notifications', ['filter' => 'admin']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'admin' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Solo Admin
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications List -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Notificaciones</h3>
        </div>
        <div class="p-6">
            @if($notifications->count() > 0)
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow {{ !$notification->isRead() ? 'bg-blue-50 border-blue-200' : '' }}">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 rounded-full bg-{{ $notification->color }}-100 flex items-center justify-center">
                                                <i class="{{ $notification->icon }} text-{{ $notification->color }}-600 text-lg"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="text-lg font-medium text-gray-900">{{ $notification->title }}</h4>
                                                <div class="flex items-center space-x-2">
                                                    @if(!$notification->isRead())
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            Nuevo
                                                        </span>
                                                    @endif
                                                    <span class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                            <p class="text-gray-700 mt-1">{{ $notification->message }}</p>
                                            
                                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                <span>Para: {{ $notification->user->name }}</span>
                                                <span>Tipo: {{ ucfirst($notification->type) }}</span>
                                                @if($notification->data)
                                                    <span>Datos: {{ json_encode($notification->data) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="ml-4 flex flex-col space-y-2">
                                    @if(!$notification->isRead())
                                        <form method="POST" action="{{ route('admin.notifications.mark-read', $notification) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800" title="Marcar como leída">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.notifications.destroy', $notification) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta notificación?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-bell text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay notificaciones</h3>
                    <p class="text-gray-600">No se encontraron notificaciones con los filtros aplicados.</p>
                </div>
            @endif
        </div>
    </div>
@endsection




