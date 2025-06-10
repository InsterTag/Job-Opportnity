@extends('layouts.home')

@section('content')
<main class="container mx-auto py-8 px-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-blue-800">Categorías</h2>
        <a href="{{ route('category-create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Nueva Categoría
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('category-edit', $category->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Editar</a>
                            <form action="{{ route('category-delete', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                            No hay categorías registradas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
