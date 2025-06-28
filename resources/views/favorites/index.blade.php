    @extends('layouts.home')

    @section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mis Favoritos</h1>
            <a href="{{ route('home') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                ← Volver al inicio
            </a>
        </div>

        {{-- Sección Ofertas de Trabajo --}}
        <div class="mb-10">
            <h2 class="text-2xl font-semibold text-purple-700 flex items-center mb-4">
                <svg class="w-6 h-6 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                Ofertas de Trabajo
            </h2>

            @forelse($favoriteJobOffers as $jobOffer)
                <div class="bg-white shadow-md rounded-lg p-6 mb-4 border border-gray-100 hover:shadow-lg transition relative">
                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $jobOffer->title }}</h3>
                    <p class="text-gray-600 mb-2">{{ Str::limit($jobOffer->description, 150) }}</p>
                    <div class="text-sm text-gray-500 mb-2">
                        Empresa: <span class="font-medium">{{ $jobOffer->company->name }}</span>
                    </div>

                    <button onclick="toggleFavorite(this, 'joboffer', {{ $jobOffer->id }}, true)"
                            class="absolute top-4 right-4 text-yellow-500 hover:text-red-500 transition" title="Quitar de favoritos">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14 2 9.27l6.91-1.01z"/>
                        </svg>
                    </button>
                </div>
            @empty
                <p class="text-gray-500 italic">No tienes ofertas de trabajo favoritas.</p>
            @endforelse
        </div>

        {{-- Sección Clasificados --}}
        <div>
            <h2 class="text-2xl font-semibold text-blue-700 flex items-center mb-4">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L15.09 8.26L22 9.27l-5 4.87L18.18 22L12 18.56L5.82 22L7 14.14l-5-4.87l6.91-1.01L12 2z"/>
                </svg>
                Clasificados
            </h2>

            @forelse($favoriteClassifieds as $classified)
                <div class="bg-white shadow-md rounded-lg p-6 mb-4 border border-gray-100 hover:shadow-lg transition relative">
                    <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $classified->title }}</h3>
                    <p class="text-gray-600 mb-2">{{ Str::limit($classified->description, 150) }}</p>
                    <div class="text-sm text-gray-500 mb-2">
                        Publicado por: 
                        <span class="font-medium">
                            {{ $classified->company?->name ?? $classified->unemployed?->name }}
                        </span>
                    </div>

                    <button onclick="toggleFavorite(this, 'classified', {{ $classified->id }}, true)"
                            class="absolute top-4 right-4 text-yellow-500 hover:text-red-500 transition" title="Quitar de favoritos">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.56 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z"/>
                        </svg>
                    </button>
                </div>
            @empty
                <p class="text-gray-500 italic">No tienes clasificados favoritos.</p>
            @endforelse
        </div>
    </div>
    @endsection

    @push('scripts')
    <script>
    function toggleFavorite(button, type, id, removeElement = false) {
        fetch("{{ route('favorites.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').content,
            },
            body: JSON.stringify({ type, id }),
        })
        .then(response => response.json())
        .then(data => {
            if (removeElement && !data.isFavorite) {
                button.closest('div').remove();
            }
        })
        .catch(error => {
            console.error('Error al quitar favorito:', error);
            alert('No se pudo cambiar el estado de favorito.');
        });
    }
    </script>
    @endpush
