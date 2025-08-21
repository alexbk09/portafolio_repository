@extends('layouts.client')

@section('title', 'Mis Testimonios')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Mis Testimonios</h2>
                <p class="text-gray-600">Gestiona tus testimonios y opiniones</p>
            </div>
            <a href="{{ route('testimonials.create') }}" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Nuevo Testimonio
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

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
                                    </div>
                                </div>
                                
                                <div class="ml-4 flex flex-col space-y-2">
                                    <form method="POST" action="{{ route('testimonials.destroy', $testimonial) }}" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este testimonio?')">
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
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No tienes testimonios</h3>
                    <p class="text-gray-600 mb-6">Aún no has dejado ningún testimonio.</p>
                    <a href="{{ route('testimonials.create') }}" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-secondary transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Dejar Primer Testimonio
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
