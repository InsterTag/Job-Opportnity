@extends('layouts.home') 
<!-- Extiende la plantilla base -->

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Mis Portafolios</h1>

    <div class="text-right mb-6">
        <a href="{{ route('portfolio-form') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-400 transition duration-200">
            + Agregar Portafolio
        </a>
    </div>

    @if($portfolios->isEmpty())
        <div class="text-center text-gray-600">
            <p>No tienes portafolios aún.</p>
        </div>
    @else
        <div class="grid gap-6">
            @foreach($portfolios as $portfolio)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $portfolio->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $portfolio->description }}</p>

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div class="space-x-3">
                            <a href="{{ $portfolio->url_proyect }}" target="_blank" class="text-blue-600 hover:underline">
                                🌐 Ver Proyecto
                            </a>

                            @if($portfolio->url_pdf)
                                <a href="{{ asset('storage/portfolios/' . $portfolio->url_pdf) }}" target="_blank" class="text-purple-600 hover:underline">
                                    📄 Ver PDF
                                </a>
                            @endif
                        </div>

                        <div class="flex gap-2 mt-2 sm:mt-0">
                            <a href="{{ route('edit-portfolio', $portfolio->id) }}" 
                               class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('delete-portfolio', $portfolio->id) }}" method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar este portafolio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
