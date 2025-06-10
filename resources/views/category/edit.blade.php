@extends('layouts.home')

@section('content')
<main class="container mx-auto py-8 px-6">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-center text-blue-800 mb-6">Editar Categoría</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('category-update', $category->id) }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nombre</label>
                <input type="text" name="name" id="name" required
                       class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('name', $category->name) }}">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('category-list') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
