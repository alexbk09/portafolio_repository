@extends('layouts.app')

@section('title', 'Gestionar Freelancers')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Gestión de Freelancers</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
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

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Freelancers</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $freelancers->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-check text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Disponibles</p>
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ $freelancers->where('freelancerProfile.is_available', true)->count() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Con Perfil</p>
                            <p class="text-2xl font-semibold text-gray-900">
                                {{ $freelancers->whereNotNull('freelancerProfile')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Freelancers List -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Lista de Freelancers</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Usuario
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Perfil
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contacto
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Registro
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($freelancers as $freelancer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" 
                                                 src="{{ $freelancer->freelancerProfile?->photo_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80' }}" 
                                                 alt="{{ $freelancer->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $freelancer->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $freelancer->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($freelancer->freelancerProfile)
                                        <div class="text-sm text-gray-900">
                                            <div class="font-medium">{{ $freelancer->freelancerProfile->title ?? 'Sin título' }}</div>
                                            @if($freelancer->freelancerProfile->bio)
                                                <div class="text-gray-500">{{ Str::limit($freelancer->freelancerProfile->bio, 50) }}</div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500">Sin perfil</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($freelancer->freelancerProfile)
                                        <div class="text-sm text-gray-900">
                                            @if($freelancer->freelancerProfile->phone)
                                                <div>{{ $freelancer->freelancerProfile->phone }}</div>
                                            @endif
                                            @if($freelancer->freelancerProfile->location)
                                                <div class="text-gray-500">{{ $freelancer->freelancerProfile->location }}</div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500">Sin información</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($freelancer->freelancerProfile?->is_available)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>
                                            Disponible
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times mr-1"></i>
                                            No Disponible
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $freelancer->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('freelancers.show', $freelancer) }}" 
                                           class="text-blue-600 hover:text-blue-900" title="Ver perfil público">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="mailto:{{ $freelancer->email }}" 
                                           class="text-green-600 hover:text-green-900" title="Enviar email">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.freelancers.destroy', $freelancer) }}" 
                                              class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este freelancer?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $freelancers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
