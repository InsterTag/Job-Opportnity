@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Ofertas de Trabajo</h1>
        <div class="flex items-center space-x-4">
            @if(auth()->user()?->unemployed)
                <a href="{{ route('favorites.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    Mis Favoritos
                </a>
            @endif

            @if(auth()->user()?->isCompany())
                <a href="{{ route('job-offers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Crear Nueva Oferta
                </a>
            @endif
        </div>
    </div>

    {{-- Filtros aquí si los tienes --}}

    <div class="grid grid-cols-1 gap-6">
        @forelse($jobOffers as $jobOffer)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold text-gray-800">
                            <a href="#" class="hover:text-blue-600 transition-colors">
                                {{ $jobOffer->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 mt-1">{{ $jobOffer->company->name }}</p>
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <span class="mr-4">{{ $jobOffer->location }}</span>
                            <span class="mr-4">{{ $jobOffer->offer_type }}</span>
                            @if($jobOffer->geolocation)
                                <span><i class="fas fa-map-marker-alt"></i> Ver en mapa</span>
                            @endif
                        </div>
                        <div class="mt-2">
                            @foreach($jobOffer->categories as $category)
                                <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-right">
                        @if(auth()->user()?->unemployed)
                            @php
                                $isFavorite = auth()->user()->unemployed->favoriteJobOffers->contains($jobOffer->id);
                            @endphp
                            <button onclick="toggleFavorite(this, 'joboffer', {{ $jobOffer->id }})"
                            class="favorite-btn {{ $isFavorite ? 'text-yellow-500' : 'text-gray-400' }}">
                            <svg class="w-6 h-6 star-filled {{ $isFavorite ? '' : 'hidden' }}" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/>
                            </svg>
                            <svg class="w-6 h-6 star-outline {{ $isFavorite ? 'hidden' : '' }}" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01z"/>
                            </svg>
                            </button>
                        @endif

                        <p class="text-lg font-semibold text-gray-800">{{ $jobOffer->salary_formatted }}</p>
                        <p class="text-sm text-gray-500">Publicado {{ $jobOffer->created_at->diffForHumans() }}</p>

                        @if(auth()->user()?->isCompany())
                            <div class="mt-2">
                                <a href="{{ route('job-offers.edit', $jobOffer->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">Editar</a>
                                <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta oferta laboral?')">
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
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-600">No se encontraron ofertas de trabajo.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $jobOffers->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleFavorite(button, type, id) {
    fetch("{{ route('favorites.toggle') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ type, id }),
    })
    .then(response => response.json())
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
        console.error('Error al cambiar favorito:', error);
        alert('No se pudo cambiar el estado de favorito.');
    });
}
</script>
@endpush
