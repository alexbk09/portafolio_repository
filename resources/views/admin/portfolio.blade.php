@extends('layouts.admin')

@section('title', 'Gestionar Portfolio')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Gestionar Portfolio</h2>
                    <button onclick="openModal()" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Agregar Proyecto
                    </button>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Projects List -->
                <div class="bg-white rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Proyectos</h3>
                    </div>
                    <div class="p-6">
                        @if($projects->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tecnologías</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destacado</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($projects as $project)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="h-12 w-12 rounded-lg object-cover">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                                                    <div class="text-sm text-gray-500">{{ Str::limit($project->description, 50) }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach($project->technologies_array as $tech)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ $tech }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($project->featured)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Destacado
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                            Normal
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <div class="flex space-x-2">
                                                        <button onclick="editProject({{ $project->id }})" class="text-blue-600 hover:text-blue-900">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form method="POST" action="{{ route('admin.portfolio.destroy', $project) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este proyecto?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900">
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
                            <div class="mt-6">
                                {{ $projects->links() }}
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">No hay proyectos registrados</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal for Add/Edit Project -->
    <div id="projectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-medium text-gray-900 mb-4">Agregar Proyecto</h3>
                
                <form id="projectForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea id="description" name="description" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                        </div>
                        
                        <div>
                            <label for="technologies" class="block text-sm font-medium text-gray-700">Tecnologías (separadas por comas)</label>
                            <input type="text" id="technologies" name="technologies" required class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Laravel, React, MySQL">
                        </div>
                        
                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700">URL del Proyecto</label>
                            <input type="url" id="url" name="url" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        
                        <div>
                            <label for="github_url" class="block text-sm font-medium text-gray-700">URL de GitHub</label>
                            <input type="url" id="github_url" name="github_url" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                            <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="featured" name="featured" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="featured" class="ml-2 block text-sm text-gray-900">Destacado</label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-secondary transition-colors">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('projectModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Agregar Proyecto';
            document.getElementById('projectForm').action = '{{ route("admin.portfolio.store") }}';
            document.getElementById('projectForm').method = 'POST';
            document.getElementById('projectForm').reset();
        }

        function closeModal() {
            document.getElementById('projectModal').classList.add('hidden');
        }

        function editProject(projectId) {
            // Aquí puedes implementar la lógica para cargar los datos del proyecto
            // Por ahora, solo abrimos el modal
            document.getElementById('projectModal').classList.remove('hidden');
            document.getElementById('modalTitle').textContent = 'Editar Proyecto';
            document.getElementById('projectForm').action = `/admin/portfolio/${projectId}`;
            document.getElementById('projectForm').method = 'POST';
            
            // Agregar el campo _method para PUT
            let methodField = document.getElementById('projectForm').querySelector('input[name="_method"]');
            if (!methodField) {
                methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                document.getElementById('projectForm').appendChild(methodField);
            }
            methodField.value = 'PUT';
        }

        // Cerrar modal al hacer clic fuera de él
        document.getElementById('projectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection
