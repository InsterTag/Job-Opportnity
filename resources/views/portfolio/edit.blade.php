@extends('layouts.home')

@section('content')
    <form action="{{ route('update-portfolio', $portfolio->id) }}" method="POST">
        @csrf
        @method('POST') <!-- Usamos POST para actualizar -->
        <main class="container mx-auto py-8 px-6">
            <h1 class="text-3xl font-bold text-center mb-8">Editar Portafolio</h1>
            <section class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-gray-700 font-medium">Título del Portafolio</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $portfolio->title) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="description" class="block text-gray-700 font-medium">Descripción</label>
                        <textarea id="description" name="description" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('description', $portfolio->description) }}</textarea>
                    </div>
                    <div>
                        <label for="file_url" class="block text-gray-700 font-medium">URL del Portafolio</label>
                        <input type="text" id="file_url" name="file_url" value="{{ old('file_url', $portfolio->file_url) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-400">Actualizar Portafolio</button>
                </div>
            </section>
        </main>
    </form>
@endsection
