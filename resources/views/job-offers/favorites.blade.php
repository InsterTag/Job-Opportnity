@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Título y botón de volver -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ofertas Favoritas</h1>
        <a href="{{ route('job-offers.index') }}" class="bg-purple-600 text-white px-6 py-2.5 rounded-lg hover:bg-purple-700 transition-colors flex items-center space-x-2 font-medium">
            <!-- Ícono de flecha -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
            <span>Volver a ofertas</span>
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6">
        @forelse($favoriteOffers as $jobOffer)
            <!-- Tarjeta de oferta favorita -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <!-- Título de la oferta -->
                            <h2 class="text-xl font-semibold text-gray-800">
                                <a href="{{ route('job-offers.show', $jobOffer) }}" class="hover:text-blue-600 transition-colors">
                                    {{ $jobOffer->title }}
                                </a>
                            </h2>
                        </div>

                        <!-- Nombre de la empresa -->
                        <p class="text-gray-600 mt-1">{{ $jobOffer->company->name }}</p>

                        <!-- Información adicional: ubicación, tipo, geolocalización -->
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <span class="mr-4">{{ $jobOffer->location }}</span>
                            <span class="mr-4">{{ $jobOffer->offer_type }}</span>
                            @if($jobOffer->geolocation)
                                <span><i class="fas fa-map-marker-alt"></i> Ver en mapa</span>
                            @endif
                        </div>

                        <!-- Categorías de la oferta -->
                        <div class="mt-2">
                            @foreach($jobOffer->categories as $category)
                                <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Botón de favorito y detalles de salario y fecha -->
                    <div class="text-right">
                        <button onclick="toggleFavorite({{ $jobOffer->id }})" 
                                class="favorite-btn mb-2 text-yellow-500 hover:text-gray-400 transition-colors"
                                data-offer-id="{{ $jobOffer->id }}">
                            <!-- Ícono de estrella -->
                            <svg class="w-6 h-6" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </button>
                        <p class="text-lg font-semibold text-gray-800">{{ $jobOffer->salary_formatted }}</p>
                        <p class="text-sm text-gray-500">Publicado {{ $jobOffer->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @empty
            <!-- Mensaje cuando no hay ofertas favoritas -->
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-600">No tienes ofertas favoritas guardadas.</p>
                <a href="{{ route('job-offers.index') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-700">
                    Explorar ofertas de trabajo
                </a>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $favoriteOffers->links() }}
    </div>
</div>

@push('scripts')
<script>
// Función para alternar el estado de favorito
function toggleFavorite(jobOfferId) {
    fetch(`/ofertas/${jobOfferId}/favorite`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const button = document.querySelector(`.favorite-btn[data-offer-id="${jobOfferId}"]`);
            const svg = button.querySelector('svg');
            // Cambiar estilo según favorito o no
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
    });
}
</script>
@endpush
@endsection
