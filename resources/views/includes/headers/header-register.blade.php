<header class="bg-white shadow mb-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo y nombre de la aplicación -->
            <div class="flex items-center">
                <a href="" class="flex items-center">
                    <!-- Imagen del logo -->
                    <img src="Estilos/Imagenes/proyecto.jpeg" alt="Job Opportunity Logo" class="w-12 h-12 rounded-full mr-3">
                    <!-- Nombre de la aplicación -->
                    <span class="text-xl font-bold">JOB OPPORTUNITY</span>
                </a>
            </div>

            <!-- Menú de navegación para pantallas medianas o mayores -->
            <nav class="hidden md:flex items-center space-x-6">
                <!-- Enlaces de navegación visibles solo cuando el usuario NO ha iniciado sesión -->
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Inicio</a>
                <a href="{{ route('training.index') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Capacitaciones</a>
                <a href="" class="text-gray-600 hover:text-blue-600 transition-colors">Clasificados</a>
                <a href="" class="text-gray-600 hover:text-blue-600 transition-colors">FAQs</a>
                <!-- Enlaces de autenticación -->
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Registrarse</a>
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors">Iniciar Sesión</a>
            </nav>

            <!-- Botón hamburguesa para abrir el menú en pantallas pequeñas -->
            <button class="md:hidden text-gray-600 hover:text-blue-600" id="mobileMenuButton">
                <i class="fas fa-bars text-2xl"></i> <!-- Ícono de menú -->
            </button>
        </div>

        <!-- Menú móvil que se despliega al hacer clic en el botón hamburguesa -->
        <div class="md:hidden hidden" id="mobileMenu">
            <nav class="py-4 space-y-4">
                <!-- Enlaces del menú móvil -->
                <a href="{{ route('home') }}" class="block text-gray-600 hover:text-blue-600">Inicio</a>
                <a href="" class="block text-gray-600 hover:text-blue-600">Clasificados</a>
                <a href="" class="block text-gray-600 hover:text-blue-600">Mensajes</a>
                <a href="" class="block text-gray-600 hover:text-blue-600">Configuración</a>
                <!-- Enlaces de autenticación (estilo en rojo para destacarlos) -->
                <a href="{{ route('register') }}" class="block text-red-600 hover:text-red-800">Registrarse</a>
                <a href="{{ route('login') }}" class="block text-red-600 hover:text-red-800">Iniciar Sesión</a>
            </nav>
        </div>
    </div>
</header>
