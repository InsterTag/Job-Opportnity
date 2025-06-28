@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">

        <!-- Título principal de la página -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Oferta de Trabajo</h1>

        <!-- Formulario para actualizar la oferta de trabajo -->
        <form action="{{ route('job-offers.update', $jobOffer) }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $jobOffer->title) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description', $jobOffer->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salario -->
            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salario</label>
                <input type="number" name="salary" id="salary" value="{{ old('salary', $jobOffer->salary) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('salary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ubicación -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                <input type="text" name="location" id="location" value="{{ old('location', $jobOffer->location) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Geolocalización -->
            <div class="mb-4">
                <label for="geolocation" class="block text-sm font-medium text-gray-700">Geolocalización (Google Maps)</label>
                <input type="text" name="geolocation" id="geolocation" value="{{ old('geolocation', $jobOffer->geolocation) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('geolocation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categorías -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Categorías</label>
                <div class="border rounded-md border-gray-300 p-4" style="max-height: 200px; overflow-y: auto;">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       id="category_{{ $category->id }}"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       {{ in_array($category->id, old('categories', $jobOffer->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
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

            <!-- Botones de acción -->
            <div class="flex justify-end">
                <a href="{{ route('job-offers.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors mr-4">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Actualizar Oferta
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">

        <!-- Título principal de la página -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar Oferta de Trabajo</h1>

        <!-- Formulario para actualizar la oferta de trabajo -->
        <form action="{{ route('job-offers.update', $jobOffer) }}" method="POST" class="bg-white rounded-lg shadow-sm p-6">
            @csrf
            @method('PUT')

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $jobOffer->title) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('description', $jobOffer->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salario -->
            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salario</label>
                <input type="number" name="salary" id="salary" value="{{ old('salary', $jobOffer->salary) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('salary')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ubicación -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                <input type="text" name="location" id="location" value="{{ old('location', $jobOffer->location) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Geolocalización -->
            <div class="mb-4">
                <label for="geolocation" class="block text-sm font-medium text-gray-700">Geolocalización (Google Maps)</label>
                <input type="text" name="geolocation" id="geolocation" value="{{ old('geolocation', $jobOffer->geolocation) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('geolocation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categorías -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Categorías</label>
                <div class="border rounded-md border-gray-300 p-4" style="max-height: 200px; overflow-y: auto;">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       id="category_{{ $category->id }}"
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       {{ in_array($category->id, old('categories', $jobOffer->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
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

            <!-- Botones de acción -->
            <div class="flex justify-end">
                <a href="{{ route('job-offers.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors mr-4">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Actualizar Oferta
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
