<head>
    <!-- Configuración básica de caracteres y responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Título dinámico de la página -->
    <title>@yield('Layaout.1')</title>

    <!-- CSS principal compilado con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Librería de iconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Librería AlpineJS para interactividad ligera -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Librerías externas: SweetAlert2 para alertas y Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Estilos adicionales específicos de cada página -->
    @stack('styles')
</head>
