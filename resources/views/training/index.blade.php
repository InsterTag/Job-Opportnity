@extends('layouts.home') <!-- Extiende la plantilla principal 'home' -->

@section('content') <!-- Inicia la sección 'content' -->

<main class="container mx-auto py-8 px-6">
    <!-- Verifica si hay un mensaje de éxito en la sesión -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            <!-- Muestra el mensaje de éxito -->
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <!-- Título de la sección 'Capacitaciones Registradas' -->
        <h2 class="text-2xl font-bold text-blue-800">Capacitaciones Registradas</h2>
        
        <!-- Botón para crear una nueva capacitación -->
        <a href="{{ route('training.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Nueva Capacitación</a>
    </div>

    <!-- Tabla para mostrar las capacitaciones registradas -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <!-- Encabezados de la tabla -->
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-4 py-2 text-left">Título</th>
                    <th class="px-4 py-2 text-left">Proveedor</th>
                    <th class="px-4 py-2 text-left">Inicio</th>
                    <th class="px-4 py-2 text-left">Fin</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            
            <!-- Cuerpo de la tabla, mostrando los datos de las capacitaciones -->
            <tbody>
                @forelse($trainings as $item) <!-- Itera sobre las capacitaciones -->
                    <tr class="border-t">
                        <!-- Muestra el título, proveedor, fecha de inicio y fecha de fin -->
                        <td class="px-4 py-2">{{ $item->title }}</td>
                        <td class="px-4 py-2">{{ $item->provider }}</td>
                        <td class="px-4 py-2">{{ $item->start_date }}</td>
                        <td class="px-4 py-2">{{ $item->end_date }}</td>
                        
                        <!-- Columnas de acciones (editar y eliminar) -->
                        <td class="px-4 py-2 flex space-x-2">
                            <!-- Enlace para editar la capacitación -->
                            <a href="{{ route('training.edit', $item->id) }}" class="text-blue-600 hover:underline">Editar</a>

                            <!-- Formulario para eliminar la capacitación con confirmación -->
                            <form action="{{ route('training.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar esta capacitación?');">
                                @csrf <!-- Token CSRF para proteger la solicitud -->
                                @method('DELETE') <!-- Método DELETE para la eliminación -->
                                <!-- Botón para eliminar -->
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty <!-- Si no hay capacitaciones registradas -->
                    <tr>
                        <!-- Mensaje indicando que no hay capacitaciones -->
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">No hay capacitaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

@endsection <!-- Fin de la sección 'content' -->
