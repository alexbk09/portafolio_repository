@extends('layouts.app')

@section('title', 'Editar Perfil - Freelancer')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Editar Perfil</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('freelancer.dashboard') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver al Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white rounded-lg shadow p-6">
                <form method="POST" action="{{ route('freelancer.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                        </div>

                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título Profesional</label>
                            <input type="text" id="title" name="title" 
                                   value="{{ old('title', $profile?->title) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Ej: Desarrollador Full-Stack">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Biografía</label>
                            <textarea id="bio" name="bio" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Cuéntanos sobre ti, tu experiencia y lo que te apasiona...">{{ old('bio', $profile?->bio) }}</textarea>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Contacto</h3>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="text" id="phone" name="phone" 
                                   value="{{ old('phone', $profile?->phone) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="+1 234 567 8900">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Ubicación</label>
                            <input type="text" id="location" name="location" 
                                   value="{{ old('location', $profile?->location) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Ciudad, País">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Professional Information -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Información Profesional</h3>
                        </div>

                        <div>
                            <label for="hourly_rate" class="block text-sm font-medium text-gray-700 mb-2">Tarifa por Hora ($)</label>
                            <input type="number" id="hourly_rate" name="hourly_rate" step="0.01" min="0"
                                   value="{{ old('hourly_rate', $profile?->hourly_rate) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="25.00">
                            @error('hourly_rate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">Años de Experiencia</label>
                            <input type="number" id="experience_years" name="experience_years" min="0"
                                   value="{{ old('experience_years', $profile?->experience_years) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="3">
                            @error('experience_years')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Skills and Services -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Habilidades y Servicios</h3>
                        </div>

                        <div>
                            <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Habilidades (separadas por comas)</label>
                            <input type="text" id="skills" name="skills" 
                                   value="{{ old('skills', $profile?->skills ? implode(', ', $profile->skills_array) : '') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Laravel, React, MySQL, JavaScript">
                            @error('skills')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="services" class="block text-sm font-medium text-gray-700 mb-2">Servicios Ofrecidos (separados por comas)</label>
                            <input type="text" id="services" name="services" 
                                   value="{{ old('services', $profile?->services ? implode(', ', $profile->services_array) : '') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Desarrollo Web, Consultoría, Mantenimiento">
                            @error('services')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Links -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Enlaces</h3>
                        </div>

                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Sitio Web</label>
                            <input type="url" id="website" name="website" 
                                   value="{{ old('website', $profile?->website) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="https://tu-sitio.com">
                            @error('website')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                            <input type="url" id="linkedin" name="linkedin" 
                                   value="{{ old('linkedin', $profile?->linkedin) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="https://linkedin.com/in/tu-perfil">
                            @error('linkedin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="github" class="block text-sm font-medium text-gray-700 mb-2">GitHub</label>
                            <input type="url" id="github" name="github" 
                                   value="{{ old('github', $profile?->github) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="https://github.com/tu-usuario">
                            @error('github')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Foto de Perfil</h3>
                            <div class="flex items-center space-x-6">
                                <div class="flex-shrink-0">
                                    <img src="{{ $profile?->photo_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=687&q=80' }}" 
                                         alt="Foto de perfil" class="w-24 h-24 rounded-full object-cover">
                                </div>
                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Subir nueva foto</label>
                                    <input type="file" id="photo" name="photo" accept="image/*"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <p class="mt-1 text-sm text-gray-500">Formatos: JPG, PNG, GIF. Máximo 2MB.</p>
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="md:col-span-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="is_available" name="is_available" value="1"
                                       {{ old('is_available', $profile?->is_available) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_available" class="ml-2 block text-sm text-gray-900">
                                    Estoy disponible para nuevos proyectos
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('freelancer.dashboard') }}" 
                           class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-save mr-2"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
