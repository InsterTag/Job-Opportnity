@extends('layouts.home')

@section('content')
<main class="container mx-auto py-8 px-6">
    <!-- Formulario de Capacitación -->
    <section class="bg-white rounded-xl shadow p-8 mb-12">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-800">Registrar Capacitación</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('training.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block font-semibold mb-1">Título</label>
                <input type="text" name="title" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Proveedor</label>
                <input type="text" name="provider" class="w-full border rounded p-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Descripción</label>
                <textarea name="description" rows="3" class="w-full border rounded p-2"></textarea>
            </div>
            <div>
                <label class="block font-semibold mb-1">Enlace</label>
                <input type="url" name="link" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Fecha de Inicio</label>
                <input type="date" name="start_date" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Fecha de Fin</label>
                <input type="date" name="end_date" class="w-full border rounded p-2">
            </div>
            <div class="md:col-span-2 text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Guardar Capacitación
                </button>
            </div>
        </form>
    </section>

    <!-- Lista de Capacitaciones -->
    <section class="bg-gray-50 rounded-xl shadow p-8">
        <h2 class="text-2xl font-bold mb-6 text-blue-800 text-center">Capacitaciones Registradas</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Título</th>
                        <th class="px-4 py-2 text-left">Proveedor</th>
                        <th class="px-4 py-2 text-left">Inicio</th>
                        <th class="px-4 py-2 text-left">Fin</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($trainings as $training)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $training->title }}</td>
                            <td class="px-4 py-2">{{ $training->provider }}</td>
                            <td class="px-4 py-2">{{ $training->start_date }}</td>
                            <td class="px-4 py-2">{{ $training->end_date }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('training.destroy', $training->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar esta capacitación?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">No hay capacitaciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
