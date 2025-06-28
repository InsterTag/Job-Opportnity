@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Clasificados</h1>
        <div class="flex items-center space-x-4">
            @auth
                @if(auth()->user()->unemployed)
                    <a href="{{ route('classifieds.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Crear Nuevo Clasificado
                    </a>

                    <a href="{{ route('favorites.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Mis Favoritos
                    </a>
                @endif

                @if(auth()->user()->company)
                    <a href="{{ route('classifieds.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Crear Nuevo Clasificado
                    </a>
                @endif
            @endauth
        </div>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('classifieds.index') }}" class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Ubicación</label>
                <input type="text" name="location" id="location" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" placeholder="Buscar por ubicación" value="{{ request('location') }}">
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                <select name="category_id" id="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                    <option value="">Todas las categorías</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Buscar</button>
            </div>
        </div>
    </form>

    {{-- Clasificados --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse($classifieds as $classified)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-gray-800">
                            <a href="{{ route('classifieds.show', $classified->id) }}" class="hover:text-blue-600">
                                {{ $classified->title }}
                            </a>
                        </h2>
                        @if($classified->company)
                            <p class="text-gray-600 mt-1">{{ $classified->company->business_name }}</p>
                        @elseif($classified->unemployed)
                            <p class="text-gray-600 mt-1">{{ $classified->unemployed->name }}</p>
                        @endif

                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <span class="mr-4">{{ $classified->location }}</span>
                            @if($classified->salary)
                                <span class="mr-4 text-green-600 font-semibold">${{ number_format($classified->salary, 2) }}</span>
                            @endif
                        </div>

                        <p class="mt-3 text-gray-700">{{ Str::limit($classified->description, 200) }}</p>
                    </div>

                    <div class="text-right mt-2">
                        @auth
                            @php
                                $isOwner = (auth()->user()->company && auth()->user()->company->id === $classified->company_id)
                                        || (auth()->user()->unemployed && auth()->user()->unemployed->id === $classified->unemployed_id);

                                $isFavorite = auth()->user()->unemployed
                                    ? auth()->user()->unemployed->favoriteClassifieds->contains($classified->id)
                                    : false;
                            @endphp

                            @if($isOwner)
                                <a href="{{ route('classifieds.edit', $classified->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
                                <form action="{{ route('classifieds.destroy', $classified->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro que deseas eliminar este clasificado?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded ml-2 hover:bg-red-700">Eliminar</button>
                                </form>
                            @endif

                            @if(auth()->user()->unemployed && !$isOwner)
                                <button onclick="toggleFavorite(this, 'classified', {{ $classified->id }})"
                                    class="favorite-btn mt-2 {{ $isFavorite ? 'text-yellow-500' : 'text-gray-400' }}">
                                    <svg class="w-6 h-6 star-filled {{ $isFavorite ? '' : 'hidden' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/>
                                    </svg>
                                    <svg class="w-6 h-6 star-outline {{ $isFavorite ? 'hidden' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/>
                                    </svg>
                                </button>
                            @endif
                        @endauth

                        <p class="text-sm text-gray-500 mt-2">Publicado {{ $classified->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-600">No se encontraron clasificados.</p>
                @if(auth()->user()?->company)
                    <a href="{{ route('classifieds.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Crear tu primer clasificado</a>
                @endif
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $classifieds->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleFavorite(button, type, id) {
    fetch(`/favorites/toggle`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        credentials: 'same-origin',
        body: JSON.stringify({ type, id })
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la respuesta');
        return response.json();
    })
    .then(data => {
        const filled = button.querySelector('.star-filled');
        const outline = button.querySelector('.star-outline');

        if (data.isFavorite) {
            filled.classList.remove('hidden');
            outline.classList.add('hidden');
            button.classList.remove('text-gray-400');
            button.classList.add('text-yellow-500');
        } else {
            filled.classList.add('hidden');
            outline.classList.remove('hidden');
            button.classList.remove('text-yellow-500');
            button.classList.add('text-gray-400');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al marcar como favorito.');
    });
}
</script>
@endpush
