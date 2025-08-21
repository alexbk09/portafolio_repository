<nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md z-50 border-b border-gray-200">
    <div class="mx-56 px-4 sm:px-6 lg:px-8">
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
