@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">

        <!-- Título de la página -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Clasificado</h1>

        <!-- Formulario -->
        <form method="POST" action="{{ route('classifieds.update', $classified->id) }}" class="bg-white rounded-lg shadow-sm p-6">
            @csrf
            @method('PUT')

            <!-- Campo: Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $classified->title) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                          required>{{ old('description', $classified->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Ubicación -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                <input type="text" name="location" id="location"
                       value="{{ old('location', $classified->location) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Geolocalización -->
            <div class="mb-4">
                <label for="geolocation" class="block text-sm font-medium text-gray-700">Coordenadas (opcional)</label>
                <input type="text" name="geolocation" id="geolocation"
                       value="{{ old('geolocation', $classified->geolocation) }}"
                       placeholder="Ej: 4.7110,-74.0721"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Latitud y longitud separadas por coma</p>
                @error('geolocation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Salario -->
            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salario (opcional)</label>
                <input type="number" step="0.01" name="salary" id="salary"
                       value="{{ old('salary', $classified->salary) }}"
                       placeholder="Ej: 1500.00"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('salary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Campo: Categorías -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Categorías</label>
                <div class="border rounded-md border-gray-300 p-4 max-h-48 overflow-y-auto">
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       id="category_{{ $category->id }}"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       {{ in_array($category->id, old('categories', $classified->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label for="category_{{ $category->id }}" class="ml-2 text-sm text-gray-700">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('categories')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end">
                <a href="{{ url()->previous() }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors mr-4">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Actualizar Clasificado
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
