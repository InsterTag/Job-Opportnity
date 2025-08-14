@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header mejorado -->
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-graduation-cap text-blue-800 mr-3"></i>
                        Capacitaciones
                    </h1>
                    <p class="text-gray-600">Gestiona tu formación y desarrollo profesional</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('training.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                        <i class="fas fa-plus mr-2"></i>
                        Nueva Capacitación
                    </a>
                    <!-- Botón de Inscripciones agregado -->
                    <a href="{{ route('training.inscripciones') }}" class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 flex items-center shadow-soft transition-all duration-300">
                        <i class="fas fa-list-alt mr-2"></i>
                        Ver Inscripciones
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-xl mb-6 shadow-soft animate-slide-in">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 animate-slide-in">
        @forelse($trainings as $item)
            <div class="card-enhanced hover-lift p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    <i class="fas fa-certificate text-blue-700 mr-2"></i>
                                    {{ $item->title }}
                                </h2>
                                <div class="flex items-center mb-3">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium mr-3">
                                        <i class="fas fa-building mr-1"></i>
                                        {{ $item->provider }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-play-circle text-green-600 mr-1"></i>
                                <span>Inicio: {{ $item->start_date }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-stop-circle text-red-600 mr-1"></i>
                                <span>Fin: {{ $item->end_date }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-gray-600 mr-1"></i>
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end">
                        <div class="flex space-x-2 mb-3">
                            <a href="{{ route('training.edit', $item->id) }}" 
                               class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-4 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                <i class="fas fa-edit mr-1"></i>
                                Editar
                            </a>
                            <form action="{{ route('training.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta capacitación?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-gradient-to-r from-red-800 to-red-900 text-white px-4 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                    <i class="fas fa-trash mr-1"></i>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card-enhanced p-12 text-center animate-fade-in-up">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-graduation-cap text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No tienes capacitaciones registradas</h3>
                <p class="text-gray-600 mb-6">Comienza a agregar tu formación y certificaciones para destacar tu perfil.</p>
                <a href="{{ route('training.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Agregar Primera Capacitación
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
