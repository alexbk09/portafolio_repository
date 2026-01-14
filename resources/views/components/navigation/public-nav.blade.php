<nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-primary">Keiber Paez</h1>
            </div>
            
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="#home" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Inicio</a>
                    <a href="#about" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Sobre Mí</a>
                    <a href="#portfolio" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Portfolio</a>
                    <a href="#skills" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Skills</a>
                    <a href="#testimonials" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Testimonios</a>
                    <a href="#contact" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Contacto</a>
                    <a href="{{ route('freelancers.index') }}" class="nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Freelancers</a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                            Dashboard
                        </a>
                    @elseif(auth()->user()->isFreelancer())
                        <a href="{{ route('freelancer.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                            Mi Dashboard
                        </a>
                                         @elseif(auth()->user()->isClient())
                         <a href="{{ route('client.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                             Mi Dashboard
                         </a>
                     @else
                         <a href="#" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                             Mi Cuenta
                         </a>
                     @endif
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-secondary transition-colors">
                            Registrarse
                        </a>
                    @endif
                @endauth
                <!-- Botón hamburguesa (solo móvil) -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" aria-controls="mobile-menu" aria-expanded="false" class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:text-primary hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary">
                        <!-- Icono abrir -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icono cerrar -->
                        <svg class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menú móvil -->
        <div class="md:hidden" id="mobile-menu" hidden>
            <div class="space-y-1 px-2 pt-2 pb-3">
                <a href="#home" class="block nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Inicio</a>
                <a href="#about" class="block nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Sobre Mí</a>
                <a href="#portfolio" class="block nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Portfolio</a>
                <a href="#skills" class="block nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Skills</a>
                <a href="#testimonials" class="block nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Testimonios</a>
                <a href="#contact" class="block nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Contacto</a>
                <a href="{{ route('freelancers.index') }}" class="block nav-link text-gray-700 hover:text-primary px-3 py-2 text-sm font-medium">Freelancers</a>
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        position: relative;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 0;
        background-color: #3b82f6;
        transition: width 0.3s ease;
    }
    .nav-link:hover::after {
        width: 100%;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        if (!btn || !menu) return;
        const icons = btn.querySelectorAll('svg');
        const iconOpen = icons[0];
        const iconClose = icons[1];

        btn.addEventListener('click', function () {
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', (!expanded).toString());
            if (expanded) {
                menu.hidden = true;
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
            } else {
                menu.hidden = false;
                iconOpen.classList.add('hidden');
                iconClose.classList.remove('hidden');
            }
        });
    });
</script>
