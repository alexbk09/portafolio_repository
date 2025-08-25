@props(['items' => []])

<div class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <!-- Home -->
                <li>
                    <div>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary transition-colors">
                            <i class="fas fa-home"></i>
                            <span class="sr-only">Inicio</span>
                        </a>
                    </div>
                </li>
                
                <!-- Dynamic breadcrumb items -->
                @foreach($items as $item)
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mr-4"></i>
                            @if(isset($item['url']) && !$loop->last)
                                <a href="{{ $item['url'] }}" class="text-gray-500 hover:text-primary transition-colors">
                                    @if(isset($item['icon']))
                                        <i class="{{ $item['icon'] }} mr-1"></i>
                                    @endif
                                    {{ $item['label'] }}
                                </a>
                            @else
                                <span class="text-gray-900 font-medium">
                                    @if(isset($item['icon']))
                                        <i class="{{ $item['icon'] }} mr-1"></i>
                                    @endif
                                    {{ $item['label'] }}
                                </span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>




