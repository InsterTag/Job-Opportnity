@extends('layouts.new-user') {{-- Extiende el layout principal para la sección de nuevos usuarios --}}

@section('content')
<form action="{{ route('agg-unemployed') }}" method="POST">
    @csrf {{-- Token CSRF para proteger el formulario de ataques de falsificación de solicitudes --}}
    
    <main class="container mx-auto py-8 px-6">
        <!-- Título principal de la página -->
        <h1 class="text-3xl font-bold text-center mb-8">Formulario de Desempleado</h1>
        
        <!-- Sección del formulario donde se ingresan los detalles del desempleado -->
        <section class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
            <div class="space-y-4">
                
                <!-- Campo para ingresar la profesión del desempleado -->
                <div>
                    <label for="profession" class="block text-gray-700 font-medium">Profesión</label>
                    <input type="text" id="profession" name="profession" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                           required>
                </div>

                <!-- Campo para ingresar la experiencia del desempleado -->
                <div>
                    <label for="experience" class="block text-gray-700 font-medium">Experiencia</label>
                    <textarea id="experience" name="experience" 
                              class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                              required></textarea>
                </div>
                
                <!-- Campo para ingresar la ubicación del desempleado -->
                <div>
                    <label for="location" class="block text-gray-700 font-medium">Ubicación</label>
                    <input type="text" id="location" name="location" 
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                           required>
                </div>

                <!-- Botón para enviar el formulario y registrar al desempleado -->
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-400">
                    Registrar Desempleado
                </button>
            </div>
        </section>
    </main>
</form>
@endsection
