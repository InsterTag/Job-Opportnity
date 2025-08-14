@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-6 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-green-800 mb-2">
                    <i class="fas fa-list-alt mr-3"></i>
                    Inscripciones a Capacitaciones
                </h1>
            </div>
            <a href="{{ route('training.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-xl hover:bg-gray-700 flex items-center shadow-soft transition-all duration-300">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver a la lista
            </a>
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

    @forelse($trainings as $training)
        <div class="bg-white shadow-soft rounded-2xl p-6 mb-6">
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800 mb-1"><i class="fas fa-certificate text-blue-700 mr-2"></i>{{ $training->title }}</p>
                <p class="text-gray-700 mb-1"><strong>Proveedor:</strong> {{ $training->provider }}</p>
                <div class="flex flex-wrap items-center gap-4 mb-2 text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-play-circle text-green-600 mr-1"></i>
                        <span><strong>Inicio:</strong> {{ $training->start_date }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-stop-circle text-red-600 mr-1"></i>
                        <span><strong>Fin:</strong> {{ $training->end_date }}</span>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-base font-semibold text-gray-700 mb-2">Inscritos:</h3>
                <ul class="space-y-2">
                    @forelse($training->trainingUsers as $inscription)
                        <li class="bg-gray-50 rounded-lg px-4 py-2 flex flex-col md:flex-row md:items-center md:space-x-4 text-gray-700 shadow">
                            <span><strong>ID Cesante:</strong> {{ $inscription->cesante_id }}</span>
                            <span><strong>Fecha de inscripción:</strong> {{ $inscription->fecha_inscripcion }}</span>
                            <span><strong>Completado:</strong> {{ $inscription->completado ? 'Sí' : 'No' }}</span>
                        </li>
                    @empty
                        <li class="text-gray-400">No hay inscripciones para esta capacitación.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    @empty
        <div class="card-enhanced p-12 text-center animate-fade-in-up">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-list-alt text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No hay inscripciones registradas</h3>
        </div>
    @endforelse
</div>
@endsection
