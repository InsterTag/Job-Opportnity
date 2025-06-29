<!DOCTYPE html>
<html lang="es"> <!-- Define el idioma del contenido del documento como español -->

    @include('includes.links') 
    <!-- Incluye un archivo Blade que probablemente contiene enlaces a hojas de estilo (CSS), fuentes u otros recursos -->

    <body class="bg-gray-100 text-gray-800">
        <!-- Clase Tailwind para fondo gris claro y texto gris oscuro -->

        @include('includes/headers/header-register') 
        <!-- Incluye el encabezado específico para la página de registro -->

        <div class="main-content mb-8">
            @yield('content') 
            <!-- Aquí se insertará el contenido de cada vista que extienda esta plantilla -->
        </div>

        @include('includes.footer') 
        <!-- Incluye el pie de página común del sitio -->

        @vite('resources/js/app.js') 
        <!-- Usa Vite para cargar el archivo JavaScript principal de la aplicación (configurado en Laravel) -->
    </body>
</html>
