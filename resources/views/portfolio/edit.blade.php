@extends('layouts.home') 
<!-- Extiende la plantilla base 'home' -->

@section('content')
    <!-- Inicio de la sección de contenido -->

    <form action="{{ route('update-portfolio', $portfolio->id) }}" method="POST">
        @csrf 
        <!-- Token de seguridad CSRF -->

        @method('POST') 
        <!-- Simula el método POST, aunque para actualizar usualmente se usa PUT o PATCH -->

        <main class="container mx-auto py-8 px-6">
            <h1 class="text-3xl font-bold text-center mb-8">Editar Portafolio</h1>

            <section class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
                <!-- Contenedor del formulario con diseño centrado y estilos -->

                <div class="space-y-4">
                    <!-- Espaciado vertical entre los campos -->

                    <div>
                        <label for="title" class="block text-gray-700 font-medium">Título del Portafolio</label>
                        <input type="text" id="title" name="title" 
                               value="{{ old('title', $portfolio->title) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <!-- Campo de texto con valor precargado desde el modelo -->
                    </div>

                    <div>
                        <label for="description" class="block text-gray-700 font-medium">Descripción</label>
                        <textarea id="description" name="description" 
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            {{ old('description', $portfolio->description) }}
                        </textarea>
                        <!-- Textarea con descripción existente -->
                    </div>

                    <div>
                        <label for="file_url" class="block text-gray-700 font-medium">URL del Portafolio</label>
                        <input type="text" id="file_url" name="file_url" 
                               value="{{ old('file_url', $portfolio->file_url) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <!-- Campo para la URL, precargado -->
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-400">
                        Actualizar Portafolio
                    </button>
                    <!-- Botón de envío -->
                </div>
            </section>
        </main>
    </form>
@endsection
