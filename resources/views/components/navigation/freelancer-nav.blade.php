<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-primary">Keiber Paez</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Bienvenido, {{ Auth::user()->name }}</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Freelancer
                </span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-primary transition-colors">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg min-h-screen">
        <div class="p-4">
            <nav class="space-y-2">
                <a href="{{ route('freelancer.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('freelancer.dashboard') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Mi Dashboard
                </a>
                <a href="{{ route('freelancer.profile') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('freelancer.profile*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                    <i class="fas fa-user mr-3"></i>
                    Mi Perfil
                </a>
                <a href="{{ route('freelancer.edit') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('freelancer.edit*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                    <i class="fas fa-edit mr-3"></i>
                    Editar Perfil
                </a>

                <!-- Enlace común -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <a href="/" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-home mr-3"></i>
                        Ver Sitio Web
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </div>
</div>

