@extends('layouts.admin')

@section('title', 'Nueva Cotización')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Nueva Cotización</h2>
                <p class="text-gray-600">Describe tu proyecto para obtener una cotización personalizada</p>
            </div>
            <a href="{{ route('client.quotes') }}" class="text-primary hover:text-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a Cotizaciones
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Información del Proyecto</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('quotes.store') }}">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label for="project_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Proyecto *</label>
                        <input type="text" id="project_name" name="project_name" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('project_name') border-red-500 @enderror"
                               value="{{ old('project_name') }}" placeholder="Ej: Sitio web corporativo">
                        @error('project_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="project_type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Proyecto *</label>
                        <select id="project_type" name="project_type" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('project_type') border-red-500 @enderror">
                            <option value="">Seleccionar tipo de proyecto</option>
                            <option value="web" {{ old('project_type') === 'web' ? 'selected' : '' }}>Desarrollo Web</option>
                            <option value="mobile" {{ old('project_type') === 'mobile' ? 'selected' : '' }}>Aplicación Móvil</option>
                            <option value="design" {{ old('project_type') === 'design' ? 'selected' : '' }}>Diseño UI/UX</option>
                            <option value="consulting" {{ old('project_type') === 'consulting' ? 'selected' : '' }}>Consultoría IT</option>
                            <option value="other" {{ old('project_type') === 'other' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('project_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción del Proyecto *</label>
                        <textarea id="description" name="description" rows="6" required 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('description') border-red-500 @enderror"
                                  placeholder="Describe detalladamente tu proyecto, funcionalidades requeridas, objetivos, etc.">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Máximo 2000 caracteres</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="budget_min" class="block text-sm font-medium text-gray-700 mb-2">Presupuesto Mínimo (USD)</label>
                            <input type="number" id="budget_min" name="budget_min" min="0" step="100"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('budget_min') border-red-500 @enderror"
                                   value="{{ old('budget_min') }}" placeholder="Ej: 1000">
                            @error('budget_min')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="budget_max" class="block text-sm font-medium text-gray-700 mb-2">Presupuesto Máximo (USD)</label>
                            <input type="number" id="budget_max" name="budget_max" min="0" step="100"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('budget_max') border-red-500 @enderror"
                                   value="{{ old('budget_max') }}" placeholder="Ej: 5000">
                            @error('budget_max')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Fecha Límite</label>
                        <input type="date" id="deadline" name="deadline"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('deadline') border-red-500 @enderror"
                               value="{{ old('deadline') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        @error('deadline')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Opcional. Selecciona una fecha límite si tienes una</p>
                    </div>
                </div>

                <div class="flex justify-end mt-8 space-x-4">
                    <a href="{{ route('client.quotes') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Cotización
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

