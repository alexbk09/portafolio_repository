@extends('layouts.admin')

@section('title', 'Gestión de Cotizaciones')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Gestión de Cotizaciones</h2>
        <p class="text-gray-600">Administra las solicitudes de cotización de clientes</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-file-invoice-dollar text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalQuotes }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pendientes</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingQuotes }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Aprobadas</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $approvedQuotes }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-times text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Rechazadas</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $rejectedQuotes }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Filtros</h3>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.quotes') }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Todos
                    </a>
                    <a href="{{ route('admin.quotes', ['filter' => 'pending']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'pending' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Pendientes
                    </a>
                    <a href="{{ route('admin.quotes', ['filter' => 'approved']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'approved' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Aprobadas
                    </a>
                    <a href="{{ route('admin.quotes', ['filter' => 'rejected']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'rejected' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Rechazadas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quotes List -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Cotizaciones</h3>
        </div>
        <div class="p-6">
            @if($quotes->count() > 0)
                <div class="space-y-6">
                    @foreach($quotes as $quote)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h4 class="text-xl font-semibold text-gray-900">{{ $quote->project_name }}</h4>
                                            <p class="text-sm text-gray-600">por {{ $quote->user->name }}</p>
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
                                    
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="text-gray-500">Enviada el {{ $quote->created_at->format('d/m/Y H:i') }}</span>
                                        <span class="text-gray-500">ID: #{{ $quote->id }}</span>
                                    </div>
                                </div>
                                
                                <div class="ml-4 flex flex-col space-y-2">
                                    <button onclick="openQuoteModal({{ $quote->id }})" class="text-blue-600 hover:text-blue-800" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    
                                    @if($quote->status === 'pending')
                                        <form method="POST" action="{{ route('admin.quotes.update-status', $quote) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="text-green-600 hover:text-green-800" title="Aprobar">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('admin.quotes.update-status', $quote) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Rechazar">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.quotes.destroy', $quote) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta cotización?')">
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
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay cotizaciones</h3>
                    <p class="text-gray-600">No se encontraron cotizaciones con los filtros aplicados.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quote Detail Modal -->
    <div id="quoteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Detalles de Cotización</h3>
                    <button onclick="closeQuoteModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="modalContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function openQuoteModal(quoteId) {
    fetch(`/admin/quotes/${quoteId}/details`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('modalContent').innerHTML = html;
            document.getElementById('quoteModal').classList.remove('hidden');
        });
}

function closeQuoteModal() {
    document.getElementById('quoteModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('quoteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeQuoteModal();
    }
});
</script>
@endpush

