@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-6 flex flex-col md:flex-row justify-between items-center">
            <h1 class="text-3xl font-bold text-blue-800 mb-2">
                <i class="fas fa-edit mr-3"></i>
                Editar Capacitación
            </h1>
            <a href="{{ route('training.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-xl hover:bg-gray-700 flex items-center shadow-soft transition-all duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a la lista
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-4 rounded-xl mb-6 shadow-soft animate-slide-in">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('training.update', $training->id) }}" method="POST" class="bg-white rounded-2xl shadow-soft p-8 space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Título</label>
            <input type="text" name="title" value="{{ old('title', $training->title) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Proveedor</label>
            <input type="text" name="provider" value="{{ old('provider', $training->provider) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea name="description" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $training->description) }}</textarea>
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Enlace</label>
            <input type="url" name="link" value="{{ old('link', $training->link) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <label class="block text-gray-700 font-semibold mb-2">Fecha de Inicio</label>
                <input type="date" name="start_date" value="{{ old('start_date', $training->start_date) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="flex-1">
                <label class="block text-gray-700 font-semibold mb-2">Fecha de Fin</label>
                <input type="date" name="end_date" value="{{ old('end_date', $training->end_date) }}" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-700 text-white px-8 py-3 rounded-xl hover:bg-blue-800 shadow-soft transition-all duration-300 font-semibold">
                <i class="fas fa-save mr-2"></i>
                Actualizar Capacitación
            </button>
        </div>
    </form>
</div>
@endsection
