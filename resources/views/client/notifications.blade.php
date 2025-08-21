@extends('layouts.client')

@section('title', 'Mis Notificaciones')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Mis Notificaciones</h2>
                <p class="text-gray-600">Gestiona tus notificaciones del sistema</p>
            </div>
            @if(auth()->user()->unreadNotifications()->count() > 0)
                <form method="POST" action="{{ route('client.notifications.read-all') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-check-double mr-2"></i>
                        Marcar Todas como Leídas
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

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
                                        <form method="POST" action="{{ route('client.notifications.read', $notification->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800" title="Marcar como leída">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
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
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No tienes notificaciones</h3>
                    <p class="text-gray-600">No hay notificaciones para mostrar.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
