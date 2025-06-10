<head>
    <!-- Configuración básica de caracteres y responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título dinámico de la página -->
    <title>@yield('Layaout.1')</title>

    <!-- CSS principal compilado con Vite -->
    @vite('resources/css/app.css')

    <!-- Librería de iconos FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Librería AlpineJS para interactividad ligera -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Archivos JS principales del proyecto -->
    @vite('resources/js/header/nav.js')
    @vite('resources/js/header/notification.js')

    <!-- Librerías externas: SweetAlert2 para alertas y Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
