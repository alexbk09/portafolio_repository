<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo y navegación principal -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <h1 class="text-2xl font-bold text-primary">Keiber Paez</h1>
                </a>
                
                <!-- Separador -->
                <div class="hidden md:block ml-6 pl-6 border-l border-gray-300">
                    <div class="flex space-x-8">
                        <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">
                            <i class="fas fa-home mr-1"></i>
                            Inicio
                        </a>
                        <a href="{{ route('portfolio.index') }}" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">
                            Portfolio
                        </a>
                        <a href="{{ route('freelancers.index') }}" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">
                            Freelancers
                        </a>
                        <a href="{{ route('testimonials.index') }}" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium {{ request()->routeIs('testimonials.*') ? 'text-primary font-semibold' : '' }}">
                            Testimonios
                        </a>
                        <a href="{{ route('contact.index') }}" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">
                            Contacto
                        </a>
                    </div>
                </div>
            </div>

            <!-- Botones de autenticación -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700">Hola, {{ Auth::user()->name }}</span>
                            
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                                    <i class="fas fa-tachometer-alt mr-1"></i>
                                    Dashboard Admin
                                </a>
                            @elseif(auth()->user()->isClient())
                                <a href="{{ route('client.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                                    <i class="fas fa-user mr-1"></i>
                                    Mi Dashboard
                                </a>
                            @elseif(auth()->user()->isFreelancer())
                                <a href="{{ route('freelancer.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                                    <i class="fas fa-briefcase mr-1"></i>
                                    Mi Dashboard
                                </a>
                            @else
                                <a href="#" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                                    <i class="fas fa-user mr-1"></i>
                                    Mi Cuenta
                                </a>
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-primary transition-colors text-sm">
                                    <i class="fas fa-sign-out-alt mr-1"></i>
                                    Salir
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">
                        <i class="fas fa-sign-in-alt mr-1"></i>
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                        <i class="fas fa-user-plus mr-1"></i>
                        Registrarse
                    </a>
                @endauth
            </div>

            <!-- Botón de menú móvil -->
            <div class="md:hidden flex items-center">
                <button type="button" class="text-gray-700 hover:text-primary focus:outline-none focus:text-primary" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Menú móvil -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-50">
                <a href="{{ route('home') }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">
                    <i class="fas fa-home mr-2"></i>
                    Inicio
                </a>
                <a href="{{ route('portfolio.index') }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">
                    <i class="fas fa-briefcase mr-2"></i>
                    Portfolio
                </a>
                <a href="{{ route('freelancers.index') }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">
                    <i class="fas fa-users mr-2"></i>
                    Freelancers
                </a>
                <a href="{{ route('testimonials.index') }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary {{ request()->routeIs('testimonials.*') ? 'text-primary font-semibold bg-blue-50' : '' }}">
                    <i class="fas fa-star mr-2"></i>
                    Testimonios
                </a>
                <a href="{{ route('contact.index') }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">
                    <i class="fas fa-envelope mr-2"></i>
                    Contacto
                </a>
                
                @auth
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard Admin
                            </a>
                        @elseif(auth()->user()->isClient())
                            <a href="{{ route('client.dashboard') }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                                <i class="fas fa-user mr-2"></i>
                                Mi Dashboard
                            </a>
                        @elseif(auth()->user()->isFreelancer())
                            <a href="{{ route('freelancer.dashboard') }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                                <i class="fas fa-briefcase mr-2"></i>
                                Mi Dashboard
                            </a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 text-gray-700 hover:text-primary">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                @else
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 text-gray-700 hover:text-primary">
                            <i class="fas fa-user-plus mr-2"></i>
                            Registrarse
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
}
</script>

<style>
/* Animaciones para hover */
.nav-link {
    transition: all 0.3s ease;
}

.nav-link:hover {
    transform: translateY(-1px);
}

/* Indicador de página activa */
.nav-link.active {
    color: var(--primary-color);
    font-weight: 600;
}

/* Variables CSS */
:root {
    --primary-color: #3B82F6;
    --secondary-color: #1E40AF;
}

.bg-primary { background-color: var(--primary-color); }
.text-primary { color: var(--primary-color); }
.hover\:bg-secondary:hover { background-color: var(--secondary-color); }
.hover\:text-primary:hover { color: var(--primary-color); }
</style>






