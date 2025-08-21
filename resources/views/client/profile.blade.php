@extends('layouts.client')

@section('title', 'Mi Perfil')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Mi Perfil</h2>
        <p class="text-gray-600">Actualiza tu información personal y empresarial</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Información del Perfil</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('client.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información Personal -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Información Personal</h4>
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" value="{{ auth()->user()->email }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                            <p class="text-xs text-gray-500 mt-1">El email no se puede cambiar</p>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="text" id="phone" name="phone" value="{{ $profile->phone ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                            <textarea id="address" name="address" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ $profile->address ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- Información Empresarial -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Información Empresarial</h4>
                        
                        <div class="mb-4">
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre de la Empresa</label>
                            <input type="text" id="company_name" name="company_name" value="{{ $profile->company_name ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>

                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Sitio Web</label>
                            <input type="url" id="website" name="website" value="{{ $profile->website ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>

                        <div class="mb-4">
                            <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Industria</label>
                            <input type="text" id="industry" name="industry" value="{{ $profile->industry ?? '' }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>

                        <div class="mb-4">
                            <label for="company_size" class="block text-sm font-medium text-gray-700 mb-2">Tamaño de la Empresa</label>
                            <select id="company_size" name="company_size" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                <option value="">Seleccionar tamaño</option>
                                <option value="1-10" {{ ($profile->company_size ?? '') == '1-10' ? 'selected' : '' }}>1-10 empleados</option>
                                <option value="11-50" {{ ($profile->company_size ?? '') == '11-50' ? 'selected' : '' }}>11-50 empleados</option>
                                <option value="51-200" {{ ($profile->company_size ?? '') == '51-200' ? 'selected' : '' }}>51-200 empleados</option>
                                <option value="201-500" {{ ($profile->company_size ?? '') == '201-500' ? 'selected' : '' }}>201-500 empleados</option>
                                <option value="500+" {{ ($profile->company_size ?? '') == '500+' ? 'selected' : '' }}>Más de 500 empleados</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Avatar -->
                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Avatar</h4>
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            @if($profile && $profile->avatar)
                                <img src="{{ Storage::url($profile->avatar) }}" alt="Avatar" 
                                     class="w-20 h-20 rounded-full object-cover">
                            @else
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Subir nueva imagen</label>
                            <input type="file" id="avatar" name="avatar" accept="image/*" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            <p class="text-xs text-gray-500 mt-1">Formatos: JPG, PNG, GIF. Máximo 2MB.</p>
                        </div>
                    </div>
                </div>

                <!-- Biografía -->
                <div class="mt-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Biografía</label>
                    <textarea id="bio" name="bio" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ $profile->bio ?? '' }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Cuéntanos un poco sobre ti y tu empresa (opcional)</p>
                </div>

                <!-- Botones -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('client.dashboard') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
