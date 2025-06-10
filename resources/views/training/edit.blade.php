@extends('layouts.home')

@section('content')
<main class="container mx-auto py-8 px-6">

    <!-- Sección del formulario para editar una capacitación -->
    <section class="bg-white rounded-xl shadow p-8 mb-12">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-800">Editar Capacitación</h2>

        <form action="{{ route('training.update', $training->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')

            <!-- Campo: Título -->
            <div>
                <label class="block font-semibold mb-1">Título</label>
                <input type="text" name="title" class="w-full border rounded p-2" value="{{ old('title', $training->title) }}" required>
            </div>

            <!-- Campo: Proveedor -->
            <div>
                <label class="block font-semibold mb-1">Proveedor</label>
                <input type="text" name="provider" class="w-full border rounded p-2" value="{{ old('provider', $training->provider) }}">
            </div>

            <!-- Campo: Descripción -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Descripción</label>
                <textarea name="description" rows="3" class="w-full border rounded p-2">{{ old('description', $training->description) }}</textarea>
            </div>

            <!-- Campo: Enlace -->
            <div>
                <label class="block font-semibold mb-1">Enlace</label>
                <input type="url" name="link" class="w-full border rounded p-2" value="{{ old('link', $training->link) }}">
            </div>

            <!-- Campo: Fecha de inicio -->
            <div>
                <label class="block font-semibold mb-1">Fecha de Inicio</label>
                <input type="date" name="start_date" class="w-full border rounded p-2" value="{{ old('start_date', $training->start_date) }}">
            </div>

            <!-- Campo: Fecha de fin -->
            <div>
                <label class="block font-semibold mb-1">Fecha de Fin</label>
                <input type="date" name="end_date" class="w-full border rounded p-2" value="{{ old('end_date', $training->end_date) }}">
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="md:col-span-2 text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Actualizar Capacitación
                </button>
            </div>
        </form>
    </section>

</main>
@endsection
