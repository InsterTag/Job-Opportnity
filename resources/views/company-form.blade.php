@extends('layouts.new-user') 
<!-- Usa una plantilla base llamada 'new-user' -->

@section('content')
<form action="{{ route('agg-company') }}" method="POST">
    @csrf 
    <!-- Protección contra ataques CSRF -->

    <main class="container mx-auto py-8 px-6">
        <h1 class="text-3xl font-bold text-center mb-8">Formulario de Empresa</h1>
        <!-- Título del formulario -->

        <section class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
            <!-- Contenedor con fondo blanco, sombra y bordes redondeados -->

            <div class="space-y-4">
                <!-- Espaciado vertical entre los campos -->

                <div>
                    <label for="company_name" class="block text-gray-700 font-medium">Nombre de la Empresa</label>
                    <input type="text" id="company_name" name="company_name" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                           required>
                    <!-- Campo de texto para el nombre de la empresa -->
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-medium">Descripción</label>
                    <textarea id="description" name="description" 
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                              required></textarea>
                    <!-- Campo de texto largo para describir la empresa -->
                </div>

                <button type="submit" 
                        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-400">
                    Registrar Empresa
                </button>
                <!-- Botón para enviar el formulario -->
            </div>
        </section>
    </main>
</form>
@endsection
