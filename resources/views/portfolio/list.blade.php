@extends('layouts.home')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Mis Portafolios</h1>

    <div class="text-right mb-4">
        <a href="{{ route('portfolio-form') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400">Agregar Portafolio</a>
    </div>

    @if($portfolios->isEmpty())
        <p>No tienes portafolios aún.</p>
    @else
        <div class="space-y-4">
            @foreach($portfolios as $portfolio)
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-xl font-semibold">{{ $portfolio->title }}</h2>
                    <p>{{ $portfolio->description }}</p>
                    <a href="{{ $portfolio->file_url }}" target="_blank" class="text-blue-500 hover:underline">Ver portafolio</a>
                    <div class="mt-2 flex gap-2">
                        <a href="{{ route('edit-portfolio', $portfolio->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                        <form action="{{ route('delete-portfolio', $portfolio->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este portafolio?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                    </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
