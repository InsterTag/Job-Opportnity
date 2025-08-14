<header class="header-glass shadow-soft sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo y nombre de la aplicación -->
            <div class="flex items-center">
                <a href="" class="flex items-center group">
                    <!-- Imagen del logo -->
                    <div class="relative">
                        <img src="Estilos/Imagenes/proyecto.jpeg" alt="Job Opportunity Logo" class="w-12 h-12 rounded-full mr-3 border-2 border-transparent group-hover:border-blue-500 transition-all duration-300">
                        <div class="absolute inset-0 rounded-full bg-gradient-primary opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <!-- Nombre de la aplicación -->
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-800 to-gray-700 bg-clip-text text-transparent">
                        JOB OPPORTUNITY
                    </span>
                </a>
            </div>

            <!-- Menú de navegación para pantallas medianas o mayores -->
            <nav class="hidden md:flex items-center space-x-8">
                <!-- Enlaces de navegación visibles solo cuando el usuario NO ha iniciado sesión -->
                <a href="{{ route('home') }}" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                    <span>Inicio</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="{{ route('training.index') }}" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                    <span>Capacitaciones</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                    <span>Clasificados</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                </a>
                <a href="" class="relative text-gray-600 hover:text-blue-800 transition-all duration-300 font-medium group">
                    <span>FAQs</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-primary group-hover:w-full transition-all duration-300"></span>
                </a>
                
                <!-- Separador visual -->
                <div class="h-6 w-px bg-gray-300"></div>
                
                <!-- Enlaces de autenticación mejorados -->
                <a href="{{ route('register') }}" class="btn-secondary text-white px-4 py-2 rounded-xl hover-lift text-sm font-medium shadow-soft">
                    <i class="fas fa-user-plus mr-1"></i>
                    Registrarse
                </a>
                <a href="{{ route('login') }}" class="btn-primary text-white px-4 py-2 rounded-xl hover-lift text-sm font-medium shadow-soft">
                    <i class="fas fa-sign-in-alt mr-1"></i>
                    Iniciar Sesión
                </a>
            </nav>

            <!-- Botón hamburguesa para abrir el menú en pantallas pequeñas -->
            <button class="md:hidden text-gray-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-all duration-300" id="mobileMenuButton">
                <i class="fas fa-bars text-xl"></i> <!-- Ícono de menú -->
            </button>
        </div>

        <!-- Menú móvil que se despliega al hacer clic en el botón hamburguesa -->
        <div class="md:hidden hidden bg-white border-t border-gray-100" id="mobileMenu">
            <nav class="py-4 space-y-3 px-4">
                <!-- Enlaces del menú móvil -->
                <a href="{{ route('home') }}" class="flex items-center text-gray-600 hover:text-blue-800 py-2 transition-colors">
                    <i class="fas fa-home mr-3 w-4"></i>
                    Inicio
                </a>
                <a href="{{ route('training.index') }}" class="flex items-center text-gray-600 hover:text-blue-800 py-2 transition-colors">
                    <i class="fas fa-graduation-cap mr-3 w-4"></i>
                    Capacitaciones
                </a>
                <a href="" class="flex items-center text-gray-600 hover:text-blue-800 py-2 transition-colors">
                    <i class="fas fa-list mr-3 w-4"></i>
                    Clasificados
                </a>
                <a href="" class="flex items-center text-gray-600 hover:text-blue-800 py-2 transition-colors">
                    <i class="fas fa-question-circle mr-3 w-4"></i>
                    FAQs
                </a>
                
                <div class="border-t border-gray-200 my-3"></div>
                
                <!-- Enlaces de autenticación móvil -->
                <a href="{{ route('register') }}" class="flex items-center justify-center btn-secondary text-white py-3 rounded-xl font-medium">
                    <i class="fas fa-user-plus mr-2"></i>
                    Registrarse
                </a>
                <a href="{{ route('login') }}" class="flex items-center justify-center btn-primary text-white py-3 rounded-xl font-medium">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Iniciar Sesión
                </a>
            </nav>
        </div>
    </div>
</header>
