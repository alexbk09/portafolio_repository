@extends('layouts.app')

@section('title', 'Seleccionar Rol - Keiber Paez')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">
                ¡Bienvenido a Keiber Paez!
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Selecciona el tipo de cuenta que mejor se adapte a ti
            </p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form method="POST" action="{{ route('social.save-role') }}" class="space-y-6">
                @csrf
                
                <div class="space-y-4">
                    <!-- Cliente -->
                    <div class="relative">
                        <input type="radio" id="role_client" name="role" value="client" class="sr-only" required>
                        <label for="role_client" class="block cursor-pointer">
                            <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-blue-500 transition-colors">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-user text-blue-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Cliente</h3>
                                        <p class="text-sm text-gray-500">
                                            Busco servicios de desarrollo y quiero contratar freelancers
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Freelancer -->
                    <div class="relative">
                        <input type="radio" id="role_freelancer" name="role" value="freelancer" class="sr-only" required>
                        <label for="role_freelancer" class="block cursor-pointer">
                            <div class="border-2 border-gray-200 rounded-lg p-6 hover:border-green-500 transition-colors">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-briefcase text-green-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-900">Freelancer</h3>
                                        <p class="text-sm text-gray-500">
                                            Soy desarrollador y quiero ofrecer mis servicios
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                @error('role')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                        <i class="fas fa-check mr-2"></i>
                        Continuar
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-xs text-gray-500">
                        Puedes cambiar tu rol más tarde en tu perfil
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Estilos para los radio buttons personalizados */
input[type="radio"]:checked + label .border-2 {
    border-color: var(--primary-color);
    background-color: rgba(59, 130, 246, 0.05);
}

input[type="radio"]:checked + label #role_client + label .border-2 {
    border-color: #3B82F6;
}

input[type="radio"]:checked + label #role_freelancer + label .border-2 {
    border-color: #10B981;
}

:root {
    --primary-color: #3B82F6;
    --secondary-color: #1E40AF;
}

.bg-primary { background-color: var(--primary-color); }
.hover\:bg-secondary:hover { background-color: var(--secondary-color); }
.focus\:ring-primary:focus { --tw-ring-color: var(--primary-color); }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    const labels = document.querySelectorAll('label[for^="role_"]');

    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remover clases activas de todos los labels
            labels.forEach(label => {
                const div = label.querySelector('div');
                div.classList.remove('border-blue-500', 'border-green-500', 'bg-blue-50', 'bg-green-50');
                div.classList.add('border-gray-200');
            });

            // Agregar clases activas al label seleccionado
            if (this.checked) {
                const label = document.querySelector(`label[for="${this.id}"]`);
                const div = label.querySelector('div');
                
                if (this.value === 'client') {
                    div.classList.remove('border-gray-200');
                    div.classList.add('border-blue-500', 'bg-blue-50');
                } else if (this.value === 'freelancer') {
                    div.classList.remove('border-gray-200');
                    div.classList.add('border-green-500', 'bg-green-50');
                }
            }
        });
    });
});
</script>
@endsection




