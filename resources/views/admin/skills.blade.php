@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Gestión de Habilidades</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Agregar Habilidad
                    </button>
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
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900">Lista de Habilidades</h2>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Categoría
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Porcentaje
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Color
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Orden
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($skills as $skill)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($skill->icon)
                                            <i class="{{ $skill->icon }} text-lg mr-3 {{ $skill->color === 'blue' ? 'text-blue-600' : ($skill->color === 'green' ? 'text-green-600' : ($skill->color === 'red' ? 'text-red-600' : ($skill->color === 'yellow' ? 'text-yellow-600' : ($skill->color === 'purple' ? 'text-purple-600' : 'text-orange-600')))) }}"></i>
                                        @endif
                                        <div class="text-sm font-medium text-gray-900">{{ $skill->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $skill->category === 'frontend' ? 'bg-blue-100 text-blue-800' : 
                                           ($skill->category === 'backend' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800') }}">
                                        {{ ucfirst($skill->category) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-3">
                                            <div class="h-2 rounded-full {{ $skill->color === 'blue' ? 'bg-blue-600' : ($skill->color === 'green' ? 'bg-green-600' : ($skill->color === 'red' ? 'bg-red-600' : ($skill->color === 'yellow' ? 'bg-yellow-600' : ($skill->color === 'purple' ? 'bg-purple-600' : 'bg-orange-600')))) }}" style="width: {{ $skill->percentage }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-900">{{ $skill->percentage }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 rounded-full mr-2 {{ $skill->color === 'blue' ? 'bg-blue-600' : ($skill->color === 'green' ? 'bg-green-600' : ($skill->color === 'red' ? 'bg-red-600' : ($skill->color === 'yellow' ? 'bg-yellow-600' : ($skill->color === 'purple' ? 'bg-purple-600' : 'bg-orange-600')))) }}"></div>
                                        <span class="text-sm text-gray-900 capitalize">{{ $skill->color }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $skill->order ?? 0 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editSkill({{ $skill->id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="deleteSkill({{ $skill->id }})" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar skill -->
<div id="skillModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Agregar Habilidad</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="skillForm">
                @csrf
                <input type="hidden" id="skillId" name="skill_id">
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <div id="nameError" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <select id="category" name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Seleccionar categoría</option>
                        <option value="frontend">Frontend</option>
                        <option value="backend">Backend</option>
                        <option value="tools">Herramientas</option>
                    </select>
                    <div id="categoryError" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="mb-4">
                    <label for="percentage" class="block text-sm font-medium text-gray-700 mb-2">Porcentaje (0-100)</label>
                    <input type="number" id="percentage" name="percentage" min="0" max="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <div id="percentageError" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="mb-4">
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icono (Font Awesome)</label>
                    <input type="text" id="icon" name="icon" placeholder="fas fa-code" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div id="iconError" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="mb-4">
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <select id="color" name="color" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Seleccionar color</option>
                        <option value="blue">Azul</option>
                        <option value="green">Verde</option>
                        <option value="red">Rojo</option>
                        <option value="yellow">Amarillo</option>
                        <option value="purple">Púrpura</option>
                        <option value="orange">Naranja</option>
                    </select>
                    <div id="colorError" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="mb-6">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Orden</label>
                    <input type="number" id="order" name="order" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="0">
                    <div id="orderError" class="text-red-500 text-sm mt-1 hidden"></div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let isEditing = false;

function openModal() {
    document.getElementById('skillModal').classList.remove('hidden');
    document.getElementById('modalTitle').textContent = 'Agregar Habilidad';
    document.getElementById('skillForm').reset();
    document.getElementById('skillId').value = '';
    isEditing = false;
    clearErrors();
}

function closeModal() {
    document.getElementById('skillModal').classList.add('hidden');
    clearErrors();
}

function clearErrors() {
    const errorElements = document.querySelectorAll('[id$="Error"]');
    errorElements.forEach(element => {
        element.classList.add('hidden');
        element.textContent = '';
    });
}

function showErrors(errors) {
    clearErrors();
    Object.keys(errors).forEach(field => {
        const errorElement = document.getElementById(field + 'Error');
        if (errorElement) {
            errorElement.textContent = errors[field][0];
            errorElement.classList.remove('hidden');
        }
    });
}

async function editSkill(skillId) {
    try {
        const response = await fetch(`/admin/skills/${skillId}/edit`);
        const skill = await response.json();
        
        document.getElementById('skillId').value = skill.id;
        document.getElementById('name').value = skill.name;
        document.getElementById('category').value = skill.category;
        document.getElementById('percentage').value = skill.percentage;
        document.getElementById('icon').value = skill.icon || '';
        document.getElementById('color').value = skill.color;
        document.getElementById('order').value = skill.order || 0;
        
        document.getElementById('modalTitle').textContent = 'Editar Habilidad';
        document.getElementById('skillModal').classList.remove('hidden');
        isEditing = true;
        clearErrors();
    } catch (error) {
        console.error('Error:', error);
        alert('Error al cargar la habilidad');
    }
}

async function deleteSkill(skillId) {
    if (!confirm('¿Estás seguro de que quieres eliminar esta habilidad?')) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/skills/${skillId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            location.reload();
        } else {
            alert('Error al eliminar la habilidad');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al eliminar la habilidad');
    }
}

document.getElementById('skillForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const skillId = document.getElementById('skillId').value;
    
    try {
        const url = isEditing ? `/admin/skills/${skillId}` : '/admin/skills';
        const method = isEditing ? 'PUT' : 'POST';
        
        const response = await fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(formData))
        });
        
        const result = await response.json();
        
        if (result.success) {
            closeModal();
            location.reload();
        } else {
            showErrors(result.errors);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error al guardar la habilidad');
    }
});
</script>
@endsection
