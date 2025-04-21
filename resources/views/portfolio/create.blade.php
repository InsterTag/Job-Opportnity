@extends('layouts.home')

@section('content')
    <form action="{{ route('agg-portfolio') }}" method="POST">
        @csrf
        <main class="container mx-auto py-8 px-6">
            <h1 class="text-3xl font-bold text-center mb-8">Agregar Portafolio</h1>
            <section class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-gray-700 font-medium">Título del Portafolio</label>
                        <input type="text" id="title" name="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="description" class="block text-gray-700 font-medium">Descripción</label>
                        <textarea id="description" name="description" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>
                    <div>
                        <label for="file_url" class="block text-gray-700 font-medium">URL del Portafolio</label>
                        <input type="text" id="file_url" name="file_url" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-400">Agregar Portafolio</button>
                </div>
            </section>
        </main>
    </form>
@endsection
