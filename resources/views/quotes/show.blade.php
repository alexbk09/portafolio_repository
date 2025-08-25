@extends('layouts.admin')

@section('title', 'Detalle de Cotización')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Detalle de Cotización</h2>
                <p class="text-gray-600">Información completa de tu solicitud</p>
            </div>
            <a href="{{ route('client.quotes') }}" class="text-primary hover:text-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a Cotizaciones
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">{{ $quote->project_name }}</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $quote->status_color }}-100 text-{{ $quote->status_color }}-800">
                    {{ $quote->status_text }}
                </span>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Información del Proyecto -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Información del Proyecto</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <span class="font-medium text-gray-700">Nombre del Proyecto:</span>
                            <p class="text-gray-900">{{ $quote->project_name }}</p>
                        </div>
                        
                        <div>
                            <span class="font-medium text-gray-700">Tipo de Proyecto:</span>
                            <p class="text-gray-900 capitalize">{{ $quote->project_type }}</p>
                        </div>
                        
                        <div>
                            <span class="font-medium text-gray-700">Descripción:</span>
                            <p class="text-gray-900 mt-1">{{ $quote->description }}</p>
                        </div>
                        
                        <div>
                            <span class="font-medium text-gray-700">Presupuesto:</span>
                            <p class="text-gray-900">{{ $quote->budget_range }}</p>
                        </div>
                        
                        <div>
                            <span class="font-medium text-gray-700">Fecha Límite:</span>
                            <p class="text-gray-900">{{ $quote->deadline ? $quote->deadline->format('d/m/Y') : 'No especificada' }}</p>
                        </div>
                        
                        <div>
                            <span class="font-medium text-gray-700">Fecha de Envío:</span>
                            <p class="text-gray-900">{{ $quote->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Estado y Notas -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Estado y Comunicación</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <span class="font-medium text-gray-700">Estado Actual:</span>
                            <div class="mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $quote->status_color }}-100 text-{{ $quote->status_color }}-800">
                                    {{ $quote->status_text }}
                                </span>
                            </div>
                        </div>
                        
                        @if($quote->admin_notes)
                            <div>
                                <span class="font-medium text-gray-700">Notas del Administrador:</span>
                                <div class="mt-2 p-3 bg-blue-50 rounded-lg">
                                    <p class="text-gray-900">{{ $quote->admin_notes }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <div>
                            <span class="font-medium text-gray-700">Última Actualización:</span>
                            <p class="text-gray-900">{{ $quote->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Acciones -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        ID de Cotización: #{{ $quote->id }}
                    </div>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('client.quotes') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Volver
                        </a>
                        <form method="POST" action="{{ route('quotes.destroy', $quote) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta cotización?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                <i class="fas fa-trash mr-2"></i>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




