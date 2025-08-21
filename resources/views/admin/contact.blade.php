@extends('layouts.app')

@section('title', 'Gestionar Mensajes')

@section('content')
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-primary">Keiber Paez</h1>
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
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-4">
                <nav class="space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.portfolio') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-briefcase mr-3"></i>
                        Portfolio
                    </a>
                    <a href="{{ route('admin.contact') }}" class="flex items-center px-4 py-2 text-gray-700 bg-blue-50 rounded-lg">
                        <i class="fas fa-envelope mr-3"></i>
                        Mensajes
                    </a>
                                         <a href="{{ route('admin.skills') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                         <i class="fas fa-code mr-3"></i>
                         Habilidades
                     </a>
                     <a href="{{ route('admin.freelancers') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                         <i class="fas fa-users mr-3"></i>
                         Freelancers
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
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Gestionar Mensajes</h2>
                    <div class="flex space-x-4">
                        <span class="text-sm text-gray-600">
                            Total: {{ $messages->total() }} mensajes
                        </span>
                        <span class="text-sm text-blue-600">
                            Sin leer: {{ $messages->where('read_at', null)->count() }}
                        </span>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Messages List -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Mensajes de Contacto</h3>
                    </div>
                    <div class="p-6">
                        @if($messages->count() > 0)
                            <div class="space-y-4">
                                @foreach($messages as $message)
                                    <div class="border border-gray-200 rounded-lg p-6 {{ $message->read_at ? 'bg-gray-50' : 'bg-blue-50' }}">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-3 mb-3">
                                                    <div class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-lg font-medium text-gray-900">{{ $message->name }}</h4>
                                                        <p class="text-sm text-gray-600">{{ $message->email }}</p>
                                                    </div>
                                                    @if(!$message->read_at)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            Nuevo
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <h5 class="font-medium text-gray-900">{{ $message->subject }}</h5>
                                                </div>
                                                
                                                <div class="text-gray-700 mb-4">
                                                    <p>{{ $message->message }}</p>
                                                </div>
                                                
                                                <div class="text-sm text-gray-500">
                                                    Recibido: {{ $message->created_at->format('d/m/Y H:i') }}
                                                    @if($message->read_at)
                                                        | Leído: {{ $message->read_at->format('d/m/Y H:i') }}
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="flex space-x-2 ml-4">
                                                @if(!$message->read_at)
                                                    <form method="POST" action="{{ route('admin.contact.mark-read', $message) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900" title="Marcar como leído">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="text-blue-600 hover:text-blue-900" title="Responder">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                                
                                                <form method="POST" action="{{ route('admin.contact.destroy', $message) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este mensaje?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $messages->links() }}
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No hay mensajes de contacto</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
