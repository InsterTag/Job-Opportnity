<!DOCTYPE html>
<html lang="es"> <!-- Documento HTML en español -->

<!-- Metaetiqueta para incluir el token CSRF, importante para proteger las solicitudes AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Inclusión de los enlaces comunes (CSS, favicon, etc.) -->
@include('includes.links')

<body class="bg-gray-100 text-gray-800"> <!-- Cuerpo de la página con fondo gris claro y texto gris oscuro -->

    <!-- Inclusión del encabezado de perfil (barra superior personalizada) -->
    @include('includes/headers/header-profile')

    <!-- Contenido principal de la página -->
    <div class="main-content">
        @yield('content') <!-- Aquí se insertará el contenido específico de cada vista -->
    </div>

    <!-- Inclusión del pie de página -->
    @include('includes.footer')

    <!-- Inclusión del archivo JavaScript principal compilado con Vite -->
    @vite('resources/js/app.js')

    <!-- Sección para apilar y cargar scripts adicionales (por ejemplo, modales o funciones JS específicas) -->
    @stack('scripts')
    
</body>
</html>
