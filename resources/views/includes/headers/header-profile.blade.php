<header class="header-glass shadow-soft sticky top-0 z-[1000]">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo de la aplicación con enlace a la página principal -->
            <a href="{{ route('home') }}" class="flex items-center group">
                <div class="relative">
                    <img src="{{ asset('images/logo.png') }}" alt="Job Opportunity Logo" class="w-12 h-12 rounded-full mr-3 border-2 border-transparent group-hover:border-blue-500 transition-all duration-300">
                    <div class="absolute inset-0 rounded-full bg-gradient-primary opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                </div>
                                    <span class="text-xl font-bold bg-gradient-to-r from-blue-800 to-gray-700 bg-clip-text text-transparent">
                        JOB OPPORTUNITY
                    </span>
            </a>

            <!-- Menú de navegación visible en pantallas medianas en adelante -->
            <nav class="hidden md:flex items-center space-x-8">
                @auth
                    <!-- Enlaces principales del menú -->
                    <a href="{{ route('home') }}" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                        <span>Inicio</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('job-offers.index') }}" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                        <span>Empleos</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('classifieds.index') }}" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                        <span>Clasificados</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('training.index') }}" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                        <span>Capacitaciones</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                    </a>

                    <!-- Icono de notificaciones -->
                    <div class="relative">
                        <a href="{{ route('notifications.index') }}" class="flex items-center text-gray-600 hover:text-blue-800 p-2 rounded-xl hover:bg-blue-50 transition-all duration-300 relative">
                            <i class="fas fa-bell text-xl"></i>
                            <!-- Badge de notificaciones no leídas -->
                            <span id="notification-badge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold hidden">
                                0
                            </span>
                        </a>
                    </div>

                    <!-- Dropdown de usuario con su información y enlaces personalizados -->
                    <div class="relative" id="userDropdown">
                        <button id="userDropdownToggle" class="flex items-center text-gray-600 hover:text-blue-800 p-2 rounded-xl hover:bg-blue-50 transition-all duration-300">
                            <!-- Imagen del usuario -->
                            <div class="relative">
                                <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'><circle cx='12' cy='8' r='3.5' fill='%23cbd5e1' /><path d='M12 14c-4 0-6 2-6 3v1h12v-1c0-1-2-3-6-3z' fill='%238b949e' /></svg>" alt="Usuario" class="w-8 h-8 rounded-full mr-2 border-2 border-transparent hover:border-blue-300 transition-all duration-300">
                                <div class="absolute bottom-0 right-1 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium max-w-[120px] truncate">
                                    @if(auth()->user()->isCompany())
                                        {{ auth()->user()->company->company_name ?? auth()->user()->name }}
                                    @else
                                        {{ auth()->user()->name }}
                                    @endif
                                </span>
                                <span class="text-xs text-gray-500">
                                    @if(auth()->user()->isUnemployed())
                                        Cesante
                                    @elseif(auth()->user()->isCompany())
                                        Empresa
                                    @endif
                                </span>
                                
                                
                            </div>
                            <!-- Ícono de flecha para indicar que hay un menú desplegable -->
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>

                        <!-- Menú desplegable del usuario -->
                        <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-soft border border-gray-100 z-50 overflow-hidden">
                            <!-- Opciones del menú -->
                            <div class="py-2">
                                @if(auth()->user()->isUnemployed())
                                    <!-- Opción para ver el portafolio si es cesante -->
                                    <a href="{{ route('portfolios.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-briefcase mr-3 w-4 text-blue-600"></i>
                                        Portafolio
                                    </a>
                                    <a href="{{ route('job-offers.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-search mr-3 w-4 text-blue-600"></i>
                                        Buscar Empleos
                                    </a>
                                @endif
                                @if(auth()->user()->isCompany())
                                    <!-- Opción para gestionar ofertas si es empresa -->
                                    <a href="{{ route('job-offers.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-plus-circle mr-3 w-4 text-blue-600"></i>
                                        Gestionar Ofertas
                                    </a>
                                    <a href="{{ route('job-offers.create') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-file-plus mr-3 w-4 text-blue-600"></i>
                                        Crear Nueva Oferta
                                    </a>
                                @endif
                                
                                <!-- Enlaces comunes -->
                                <a href="{{ route('messages') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-envelope mr-3 w-4 text-blue-600"></i>
                                    Mensajes
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-cog mr-3 w-4 text-blue-600"></i>
                                    Configuración
                                </a>
                                
                                <!-- Separador -->
                                <div class="border-t border-gray-200 my-2"></div>
                                
                                <!-- Enlace para cerrar sesión -->
                                <a href="{{ route('logout') }}" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-3 w-4"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </div>
                    </div>
                @endauth
            </nav>

            <!-- Botón hamburguesa para mostrar menú móvil -->
            <button class="md:hidden text-gray-600 hover:text-blue-600" id="mobileMenuToggle">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Menú móvil que se muestra al hacer clic en el botón hamburguesa -->
        <div class="md:hidden hidden" id="mobileMenu">
            <nav class="py-4 space-y-4 px-2">
                @auth
                    <!-- Repetición del menú para pantallas pequeñas -->
                    <a href="{{ route('home') }}" class="block text-gray-600 hover:text-blue-600">Inicio</a>
                    <a href="{{ route('job-offers.index') }}" class="block text-gray-600 hover:text-blue-600">Empleos</a>
                    <a href="{{ route('classifieds.index') }}" class="block text-gray-600 hover:text-blue-600">Clasificados</a>
                    <a href="{{ route('training.index') }}" class="block text-gray-600 hover:text-blue-600">Capacitaciones</a>
                    @if(auth()->user()->isUnemployed())
                        <a href="{{ route('portfolios.index') }}" class="block text-gray-600 hover:text-blue-600">Portafolio</a>
                    @endif
                    @if(auth()->user()->isCompany())
                        <a href="{{ route('job-offers.index') }}" class="block text-gray-600 hover:text-blue-600">Gestionar Ofertas</a>
                    @endif
                    <a href="{{ route('messages') }}" class="block text-gray-600 hover:text-blue-600">Mensajes</a>
                    <a href="#" class="block text-gray-600 hover:text-blue-600">Configuración</a>
                    <a href="{{ route('logout') }}" class="block text-red-600 hover:text-red-800">Cerrar Sesión</a>
                @endauth
            </nav>
        </div>
    </div>
</header>

<!-- Script para el menú desplegable del usuario -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userDropdownToggle = document.getElementById('userDropdownToggle');
    const userDropdownMenu = document.getElementById('userDropdownMenu');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    // Toggle para el dropdown del usuario
    if (userDropdownToggle && userDropdownMenu) {
        userDropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            userDropdownMenu.classList.toggle('hidden');
        });

        // Cerrar dropdown al hacer click fuera de él
        document.addEventListener('click', function(e) {
            if (!userDropdownToggle.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                userDropdownMenu.classList.add('hidden');
            }
        });
    }

    // Toggle para el menú móvil
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Cerrar menú móvil al redimensionar la ventana
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768 && mobileMenu) {
            mobileMenu.classList.add('hidden');
        }
    });

    // Actualizar contador de notificaciones
    function updateNotificationCount() {
        fetch('{{ route("notifications.unread-count") }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.getElementById('notification-badge');
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Actualizar contador al cargar la página
    updateNotificationCount();

    // Actualizar contador cada 30 segundos
    setInterval(updateNotificationCount, 30000);
});
</script>
