<header class="bg-white shadow mb-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="Estilos/Imagenes/proyecto.jpeg" alt="Job Opportunity Logo" class="w-12 h-12 rounded-full mr-3">
                    <span class="text-xl font-bold">JOB OPPORTUNITY</span>
                </a>
            </div>

            <!-- Menú de navegación -->
            <nav class="hidden md:flex items-center space-x-6">
                @auth
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Inicio</a>

                <!-- aqui -->
                <a href="{{ route('training.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Capacitaciones</a>
                <a href="" class="text-gray-600 hover:text-blue-600 transition-colors">Clasificados</a>
                <a href="" class="text-gray-600 hover:text-blue-600 transition-colors">FAQs</a>
                <div class="relative" id="notificationsDropdown">
                    <button class="text-gray-600 hover:text-blue-600 transition-colors relative">
                        <i class="fas fa-bell text-xl"></i>
                        <span id="notificationCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </button>
                    <div id="notificationPanel" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50">
                        <div class="p-4 border-b flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Notificaciones</h3>
                            <button data-notification-preferences class="text-gray-400 hover:text-blue-600 transition-colors">
                                <i class="fas fa-cog"></i>
                            </button>
                        </div>
                        <div id="notificationList" class="max-h-96 overflow-y-auto">
                            <!-- Las notificaciones se cargarán dinámicamente aquí -->
                        </div>
                    </div>
                </div>
                <div class="relative" id="userDropdown">
                    <button class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                        <img src="Estilos/Imagenes/proyecto2.jpeg" alt="Usuario" class="w-8 h-8 rounded-full mr-2">
                        <div class="flex flex-col items-center">
                            <span class="text-sm font-medium max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-gray-500 -mt-0.5">
                                @if(auth()->user()->isCompany())
                                    Empresa
                                @else
                                    Cesante
                                @endif
                            </span>
                        </div>
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-50">
                        @if(auth()->user()->isUnemployed())
                        <a href="{{ route('portfolio-list') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Portafolio</a>
                        @endif
                        @if(auth()->user()->isCompany())
                        <a href="{{ route('job-offers.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Crear Oferta</a>
                        @endif
                        <a href="{{ route('messages') }}" class="relative block px-4 py-2 text-gray-700 hover:bg-gray-100">Mensajes</a>
                        <a href="" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Configuración</a>
                        <hr class="my-2">
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Cerrar Sesión</a>
                    </div>
                    @endauth
                </div>
            </nav>

            <!-- Menú móvil -->
            <button class="md:hidden text-gray-600 hover:text-blue-600" id="mobileMenuButton">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Menú móvil expandible -->
        <div class="md:hidden hidden" id="mobileMenu">
            <nav class="py-4 space-y-4">
                <a href="{{ route('home') }}" class="block text-gray-600 hover:text-blue-600">Inicio</a>
                <a href="" class="block text-gray-600 hover:text-blue-600">Clasificados</a>
                <a href="" class="block text-gray-600 hover:text-blue-600">Mi Perfil</a>
                <a href="{{ route('messages') }}" class="block text-gray-600 hover:text-blue-600">Mensajes</a>
                <a href="" class="block text-gray-600 hover:text-blue-600">Configuración</a>
                <a href="{{ route('logout') }}" class="block text-red-600 hover:text-red-800">Cerrar Sesión</a>
            </nav>
        </div>
    </div>
</header>