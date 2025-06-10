@extends('layouts.home') 
<!-- Extiende la plantilla base 'home' -->

@section('content')
    <!-- Sección de contenido principal de la página -->

    <form action="{{ route('agg-portfolio') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        <!-- Token CSRF para seguridad en el envío del formulario -->

        <main class="container mx-auto py-8 px-6">
            <h1 class="text-3xl font-bold text-center mb-8">Agregar Portafolio</h1>

            <section class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
                <!-- Contenedor del formulario con estilos -->

                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-gray-700 font-medium">Título del Portafolio</label>
                        <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label for="description" class="block text-gray-700 font-medium">Descripción</label>
                        <textarea id="description" name="description" class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>

                    <div>
                        <label for="url_proyect" class="block text-gray-700 font-medium">URL del Proyecto</label>
                        <input type="url" id="url_proyect" name="url_proyect" class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label for="url_pdf" class="block text-gray-700 font-medium">Archivo PDF (opcional)</label>
                        <input type="file" id="url_pdf" name="url_pdf" accept="application/pdf" class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-400 transition-colors duration-300">
                        Agregar Portafolio
                    </button>
                </div>
            </section>
        </main>
    </form>
@endsection
