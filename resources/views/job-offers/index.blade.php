@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ofertas de Trabajo</h1>
        <div class="flex items-center space-x-4">
            {{-- Mostrar botón "Ofertas Favoritas" solo si el usuario está desempleado --}}
            @if(auth()->user() && auth()->user()->unemployed)
                {{-- NOTA: Esta ruta debe existir en las rutas web.php --}}
                <a href="{{ route('favorite-offers.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                    {{-- Ícono de estrella --}}
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Ofertas Favoritas
                </a>
            @endif
            {{-- Mostrar botón "Crear Nueva Oferta" solo si el usuario es empresa --}}
            @if(auth()->user()->isCompany())
                <a href="{{ route('job-offers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Crear Nueva Oferta
                </a>
            @endif
        </div>
    </div>

    <!-- Sección de filtros de búsqueda -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <form action="{{ route('job-offers.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Filtro por texto --}}
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            {{-- Filtro por ubicación --}}
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                <input type="text" name="location" id="location" value="{{ request('location') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            {{-- Filtro por tipo de oferta --}}
            <div>
                <label for="offer_type" class="block text-sm font-medium text-gray-700">Tipo de Oferta</label>
                <select name="offer_type" id="offer_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="contract" {{ request('offer_type') == 'contract' ? 'selected' : '' }}>Contrato</option>
                    <option value="classified" {{ request('offer_type') == 'classified' ? 'selected' : '' }}>Clasificado</option>
                </select>
            </div>
            {{-- Filtro por categoría --}}
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Todas</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- Botón de filtrar --}}
            <div class="flex items-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors w-full">
                    Filtrar
                </button>
            </div>
        </form>
    </div>

    <!-- Lista de ofertas de trabajo -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($jobOffers as $jobOffer)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            {{-- Título de la oferta --}}
                            <h2 class="text-xl font-semibold text-gray-800">
                                <a href="" class="hover:text-blue-600 transition-colors">
                                    {{ $jobOffer->title }}
                                </a>
                            </h2>
                        </div>
                        {{-- Nombre de la empresa --}}
                        <p class="text-gray-600 mt-1">{{ $jobOffer->company->name }}</p>
                        {{-- Ubicación y tipo de oferta --}}
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <span class="mr-4">{{ $jobOffer->location }}</span>
                            <span class="mr-4">{{ $jobOffer->offer_type }}</span>
                            @if($jobOffer->geolocation)
                                <span><i class="fas fa-map-marker-alt"></i> Ver en mapa</span>
                            @endif
                        </div>
                        {{-- Categorías de la oferta --}}
                        <div class="mt-2">
                            @foreach($jobOffer->categories as $category)
                                <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Acciones (favoritar, editar, eliminar) --}}
                    <div class="text-right">
                        @if(auth()->user() && auth()->user()->unemployed)
                            {{-- Botón de favorito --}}
                            <button onclick="toggleFavorite({{ $jobOffer->id }})" 
                                    class="favorite-btn mb-2 text-gray-400 hover:text-yellow-500 transition-colors"
                                    data-offer-id="{{ $jobOffer->id }}">
                                <svg class="w-6 h-6" fill="{{ auth()->user()->unemployed->favoriteOffers->contains($jobOffer->id) ? 'currentColor' : 'none' }}" 
                                        stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                            </button>
                        @endif
                        {{-- Salario --}}
                        <p class="text-lg font-semibold text-gray-800">{{ $jobOffer->salary_formatted }}</p>
                        {{-- Fecha de publicación --}}
                        <p class="text-sm text-gray-500">Publicado {{ $jobOffer->created_at->diffForHumans() }}</p>

                        {{-- Acciones para empresas (editar y eliminar) --}}
                        @if(auth()->user()->isCompany())
                            <div class="mt-2">
                                <a href="{{ route('job-offers.edit', $jobOffer->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">Editar</a>
                                <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta oferta laboral? Esta acción no se puede deshacer.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors ml-2">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            {{-- Mensaje si no hay resultados --}}
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-600">No se encontraron ofertas de trabajo que coincidan con tus criterios de búsqueda.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $jobOffers->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
// Función para alternar estado favorito de una oferta
function toggleFavorite(jobOfferId) {
    fetch(`/ofertas/${jobOfferId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Actualizar el estado del botón y el ícono
            const button = document.querySelector(`.favorite-btn[data-offer-id="${jobOfferId}"]`);
            const svg = button.querySelector('svg');
            if (data.isFavorite) {
                svg.setAttribute('fill', 'currentColor');
                button.classList.remove('text-gray-400');
                button.classList.add('text-yellow-500');
            } else {
                svg.setAttribute('fill', 'none');
                button.classList.remove('text-yellow-500');
                button.classList.add('text-gray-400');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al procesar tu solicitud. Por favor, intenta de nuevo.');
    });
}
</script>
@endpush
