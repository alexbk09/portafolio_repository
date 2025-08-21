@extends('layouts.admin')

@section('title', 'Gestión de Testimonios')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Gestión de Testimonios</h2>
        <p class="text-gray-600">Administra y modera los testimonios de clientes</p>
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
                    <i class="fas fa-star text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalTestimonials }}</p>
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
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingTestimonials }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Aprobados</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $approvedTestimonials }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-star text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Destacados</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $featuredTestimonials }}</p>
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
                    <a href="{{ route('admin.testimonials') }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === null ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Todos
                    </a>
                    <a href="{{ route('admin.testimonials', ['filter' => 'pending']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'pending' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Pendientes
                    </a>
                    <a href="{{ route('admin.testimonials', ['filter' => 'approved']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'approved' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Aprobados
                    </a>
                    <a href="{{ route('admin.testimonials', ['filter' => 'featured']) }}" 
                       class="px-3 py-1 rounded text-sm {{ request('filter') === 'featured' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Destacados
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials List -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Testimonios</h3>
        </div>
        <div class="p-6">
            @if($testimonials->count() > 0)
                <div class="space-y-6">
                    @foreach($testimonials as $testimonial)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" 
                                                 class="w-12 h-12 rounded-full object-cover mr-4">
                                            <div>
                                                <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                                                @if($testimonial->position)
                                                    <p class="text-sm text-gray-600">{{ $testimonial->position }}</p>
                                                @endif
                                                @if($testimonial->company)
                                                    <p class="text-sm text-gray-500">{{ $testimonial->company }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="flex text-yellow-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                                @endfor
                                            </div>
                                            <span class="text-sm text-gray-600">{{ $testimonial->rating }}/5</span>
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-700 italic mb-4">"{{ $testimonial->testimonial }}"</p>
                                    
                                    <div class="flex items-center space-x-4 text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $testimonial->approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $testimonial->approved ? 'Aprobado' : 'Pendiente' }}
                                        </span>
                                        @if($testimonial->featured)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-star mr-1"></i>
                                                Destacado
                                            </span>
                                        @endif
                                        <span class="text-gray-500">Enviado el {{ $testimonial->created_at->format('d/m/Y H:i') }}</span>
                                        <span class="text-gray-500">por {{ $testimonial->user->name }}</span>
                                    </div>
                                </div>
                                
                                <div class="ml-4 flex flex-col space-y-2">
                                    @if(!$testimonial->approved)
                                        <form method="POST" action="{{ route('admin.testimonials.approve', $testimonial) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-800" title="Aprobar">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($testimonial->approved)
                                        <form method="POST" action="{{ route('admin.testimonials.toggle-featured', $testimonial) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800" title="{{ $testimonial->featured ? 'Quitar destacado' : 'Destacar' }}">
                                                <i class="fas fa-star {{ $testimonial->featured ? 'text-yellow-400' : '' }}"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if(!$testimonial->approved)
                                        <form method="POST" action="{{ route('admin.testimonials.reject', $testimonial) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres rechazar este testimonio?')">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-800" title="Rechazar">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este testimonio?')">
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
                    {{ $testimonials->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-star text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No hay testimonios</h3>
                    <p class="text-gray-600">No se encontraron testimonios con los filtros aplicados.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

