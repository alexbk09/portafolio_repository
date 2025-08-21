@extends('layouts.client')

@section('title', 'Nuevo Testimonio')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Nuevo Testimonio</h2>
        <p class="text-gray-600">Comparte tu experiencia trabajando conmigo</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Información del Testimonio</h3>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Información Personal -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Información Personal</h4>
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Cargo/Puesto</label>
                            <input type="text" id="position" name="position" value="{{ old('position') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('position') border-red-500 @enderror">
                            @error('position')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Empresa</label>
                            <input type="text" id="company" name="company" value="{{ old('company') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('company') border-red-500 @enderror">
                            @error('company')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Calificación y Foto -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Calificación y Foto</h4>
                        
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Calificación *</label>
                            <div class="flex items-center space-x-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" id="rating_{{ $i }}" name="rating" value="{{ $i }}" 
                                           {{ old('rating') == $i ? 'checked' : '' }} required
                                           class="text-primary focus:ring-primary">
                                    <label for="rating_{{ $i }}" class="text-2xl text-yellow-400 cursor-pointer">
                                        <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Foto de Perfil</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('image') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 mt-1">Formatos: JPG, PNG, GIF. Máximo 2MB.</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Testimonio -->
                <div class="mt-6">
                    <label for="testimonial" class="block text-sm font-medium text-gray-700 mb-2">Tu Testimonio *</label>
                    <textarea id="testimonial" name="testimonial" rows="6" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('testimonial') border-red-500 @enderror"
                              placeholder="Cuéntanos sobre tu experiencia trabajando conmigo...">{{ old('testimonial') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Máximo 1000 caracteres. Sé específico sobre el proyecto y los resultados.</p>
                    @error('testimonial')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Información adicional -->
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <h4 class="font-medium text-blue-900 mb-2">Información Importante</h4>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Tu testimonio será revisado antes de ser publicado</li>
                        <li>• Solo se publicarán testimonios apropiados y relevantes</li>
                        <li>• Te notificaremos cuando tu testimonio sea aprobado</li>
                        <li>• Los campos marcados con * son obligatorios</li>
                    </ul>
                </div>

                <!-- Botones -->
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('client.testimonials') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Testimonio
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script para manejar la calificación visual
        document.addEventListener('DOMContentLoaded', function() {
            const ratingInputs = document.querySelectorAll('input[name="rating"]');
            const starLabels = document.querySelectorAll('label[for^="rating_"] i');

            ratingInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    // Resetear todas las estrellas
                    starLabels.forEach(star => {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    });

                    // Colorear las estrellas hasta la seleccionada
                    for (let i = 0; i <= index; i++) {
                        starLabels[i].classList.remove('text-gray-300');
                        starLabels[i].classList.add('text-yellow-400');
                    }
                });
            });

            // Si hay un valor previamente seleccionado, aplicarlo
            const selectedRating = document.querySelector('input[name="rating"]:checked');
            if (selectedRating) {
                selectedRating.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
