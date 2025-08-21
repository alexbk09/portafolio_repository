@extends('layouts.client')

@section('title', 'Mis Cotizaciones')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Mis Cotizaciones</h2>
                <p class="text-gray-600">Gestiona tus solicitudes de cotización</p>
            </div>
            <a href="{{ route('quotes.create') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Nueva Cotización
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Cotizaciones</h3>
        </div>
        <div class="p-6">
            @if($quotes->count() > 0)
                <div class="space-y-4">
                    @foreach($quotes as $quote)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h4 class="text-xl font-semibold text-gray-900">{{ $quote->project_name }}</h4>
                                            <p class="text-sm text-gray-600">Creada el {{ $quote->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $quote->status_color }}-100 text-{{ $quote->status_color }}-800">
                                            {{ $quote->status_text }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-600 mb-4">{{ Str::limit($quote->description, 200) }}</p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm mb-4">
                                        <div>
                                            <span class="font-medium text-gray-700">Tipo:</span>
                                            <span class="text-gray-600 ml-2 capitalize">{{ $quote->project_type }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Presupuesto:</span>
                                            <span class="text-gray-600 ml-2">{{ $quote->budget_range }}</span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Fecha límite:</span>
                                            <span class="text-gray-600 ml-2">{{ $quote->deadline ? $quote->deadline->format('d/m/Y') : 'No especificada' }}</span>
                                        </div>
                                    </div>
                                    
                                    @if($quote->admin_notes)
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                            <h5 class="font-medium text-blue-900 mb-2">Nota del Administrador:</h5>
                                            <p class="text-blue-800">{{ $quote->admin_notes }}</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="ml-4 flex flex-col space-y-2">
                                    <a href="{{ route('quotes.show', $quote) }}" class="text-blue-600 hover:text-blue-800" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <form method="POST" action="{{ route('quotes.destroy', $quote) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta cotización?')">
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
                    {{ $quotes->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-file-invoice-dollar text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No tienes cotizaciones</h3>
                    <p class="text-gray-600 mb-6">Aún no has creado ninguna solicitud de cotización.</p>
                    <a href="{{ route('quotes.create') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Crear Primera Cotización
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
