<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-primary">Keiber Paez</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Bienvenido, {{ Auth::user()->name }}</span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    {{ Auth::user()->isAdmin() ? 'bg-red-100 text-red-800' : 
                       (Auth::user()->isClient() ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                    {{ Auth::user()->isAdmin() ? 'Administrador' : 
                       (Auth::user()->isClient() ? 'Cliente' : 'Freelancer') }}
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
                @if(Auth::user()->isAdmin())
                    <!-- Menú para Administradores -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('dashboard') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.portfolio') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('admin.portfolio*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-briefcase mr-3"></i>
                        Portfolio
                    </a>
                    <a href="{{ route('admin.contact') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('admin.contact*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-envelope mr-3"></i>
                        Mensajes
                    </a>
                    <a href="{{ route('admin.skills') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('admin.skills*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-code mr-3"></i>
                        Habilidades
                    </a>
                    <a href="{{ route('admin.freelancers') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('admin.freelancers*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-users mr-3"></i>
                        Freelancers
                    </a>
                    <a href="{{ route('admin.testimonials') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('admin.testimonials*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-star mr-3"></i>
                        Testimonios
                    </a>
                    <a href="{{ route('admin.quotes') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('admin.quotes*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-file-invoice-dollar mr-3"></i>
                        Cotizaciones
                    </a>
                    <a href="{{ route('admin.notifications') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('admin.notifications*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-bell mr-3"></i>
                        Notificaciones
                    </a>
                @elseif(Auth::user()->isClient())
                    <!-- Menú para Clientes -->
                    <a href="{{ route('client.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('client.dashboard') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Mi Dashboard
                    </a>
                    <a href="{{ route('client.profile') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('client.profile*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-user mr-3"></i>
                        Mi Perfil
                    </a>
                    <a href="{{ route('client.quotes') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('client.quotes*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-file-invoice-dollar mr-3"></i>
                        Mis Cotizaciones
                    </a>
                    <a href="{{ route('quotes.create') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('quotes.create') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-plus mr-3"></i>
                        Nueva Cotización
                    </a>
                    <a href="{{ route('client.testimonials') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('client.testimonials*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-star mr-3"></i>
                        Mis Testimonios
                    </a>
                    <a href="{{ route('testimonials.create') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('testimonials.create') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-plus mr-3"></i>
                        Nuevo Testimonio
                    </a>
                    <a href="{{ route('client.notifications') }}" class="flex items-center px-4 py-2 text-gray-700 {{ request()->routeIs('client.notifications*') ? 'bg-blue-50 rounded-lg' : 'hover:bg-gray-50 rounded-lg transition-colors' }}">
                        <i class="fas fa-bell mr-3"></i>
                        Mis Notificaciones
                        @if(Auth::user()->unreadNotifications()->count() > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">
                                {{ Auth::user()->unreadNotifications()->count() }}
                            </span>
                        @endif
                    </a>
                @elseif(Auth::user()->isFreelancer())
                    <!-- Menú para Freelancers -->
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
                @endif

                <!-- Enlace común para todos los roles -->
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
