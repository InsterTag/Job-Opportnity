@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header mejorado -->
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-heart text-blue-800 mr-3"></i>
                        Mis Favoritos
                    </h1>
                    <p class="text-gray-600">Todas tus oportunidades guardadas en un solo lugar</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="btn-secondary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección Ofertas de Trabajo --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
                <i class="fas fa-briefcase text-blue-800 mr-3"></i>
                Ofertas de Trabajo
                <span class="ml-auto bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ count($favoriteJobOffers) }} favorita{{ count($favoriteJobOffers) == 1 ? '' : 's' }}
                </span>
            </h2>
            <p class="text-gray-600">Oportunidades laborales que te interesan</p>
        </div>

        <div class="grid grid-cols-1 gap-6 animate-slide-in">
            @forelse($favoriteJobOffers as $jobOffer)
                <div class="card-enhanced hover-lift p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                        <a href="{{ route('job-offers.show', $jobOffer->id) }}" class="hover:text-blue-800 transition-colors flex items-center group">
                                            <i class="fas fa-arrow-right text-blue-700 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                            {{ $jobOffer->title }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center mb-3">
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium mr-3">
                                            <i class="fas fa-building mr-1"></i>
                                            {{ $jobOffer->company->name }}
                                        </span>
                                        @if($jobOffer->categories->count() > 0)
                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                                <i class="fas fa-tag mr-1"></i>
                                                {{ $jobOffer->categories->first()->name }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button onclick="toggleFavorite(this, 'joboffer', {{ $jobOffer->id }}, true)"
                                        class="favorite-btn w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover-lift bg-blue-100 text-blue-800 hover:bg-gray-100 hover:text-gray-400" 
                                        title="Quitar de favoritos">
                                    <i class="fas fa-heart text-lg"></i>
                                </button>
                            </div>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                {{ Str::limit($jobOffer->description, 200) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card-enhanced p-8 text-center">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-briefcase text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No tienes ofertas laborales favoritas</h3>
                    <p class="text-gray-500 mb-6">Explora oportunidades de trabajo y guarda las que más te interesen</p>
                    <a href="{{ route('job-offers.index') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft inline-flex">
                        <i class="fas fa-search mr-2"></i>
                        Ver ofertas de trabajo
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Sección Clasificados --}}
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center">
                <i class="fas fa-bullhorn text-blue-800 mr-3"></i>
                Clasificados
                <span class="ml-auto bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ count($favoriteClassifieds) }} favorito{{ count($favoriteClassifieds) == 1 ? '' : 's' }}
                </span>
            </h2>
            <p class="text-gray-600">Anuncios y servicios que has guardado</p>
        </div>

        <div class="grid grid-cols-1 gap-6 animate-slide-in">
            @forelse($favoriteClassifieds as $classified)
                <div class="card-enhanced hover-lift p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                                        <a href="{{ route('classifieds.show', $classified->id) }}" class="hover:text-blue-800 transition-colors flex items-center group">
                                            <i class="fas fa-arrow-right text-blue-700 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                            {{ $classified->title }}
                                        </a>
                                    </h3>
                                    <div class="flex items-center mb-3">
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mr-3">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ $classified->location }}
                                        </span>
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-user mr-1"></i>
                                            {{ $classified->company?->name ?? $classified->unemployed?->name }}
                                        </span>
                                        @if($classified->salary)
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium ml-3">
                                                <i class="fas fa-dollar-sign mr-1"></i>
                                                ${{ number_format($classified->salary) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button onclick="toggleFavorite(this, 'classified', {{ $classified->id }}, true)"
                                        class="favorite-btn w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover-lift bg-blue-100 text-blue-800 hover:bg-gray-100 hover:text-gray-400" 
                                        title="Quitar de favoritos">
                                    <i class="fas fa-heart text-lg"></i>
                                </button>
                            </div>
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                {{ Str::limit($classified->description, 200) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card-enhanced p-8 text-center">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-bullhorn text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No tienes clasificados favoritos</h3>
                    <p class="text-gray-500 mb-6">Descubre anuncios y servicios interesantes para guardar</p>
                    <a href="{{ route('classifieds.index') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft inline-flex">
                        <i class="fas fa-search mr-2"></i>
                        Ver clasificados
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

    @push('scripts')
    <script>
    function toggleFavorite(button, type, id, removeElement = false) {
        // Evitar que el clic del botón propague al enlace padre
        event.stopPropagation();
        
        // Si estamos en la vista de favoritos, mostrar confirmación antes de quitar
        if (removeElement) {
            if (!confirm('¿Estás seguro de que deseas quitar este elemento de tus favoritos?')) {
                return; // Si el usuario cancela, no hacer nada
            }
        }
        
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
                // Agregar una animación suave antes de remover el elemento
                button.closest('.card-enhanced').style.transition = 'all 0.3s ease-out';
                button.closest('.card-enhanced').style.transform = 'translateX(100%)';
                button.closest('.card-enhanced').style.opacity = '0';
                
                setTimeout(() => {
                    button.closest('.card-enhanced').remove();
                    
                    // Verificar si ya no hay más elementos favoritos
                    const container = document.querySelector('.grid.grid-cols-1');
                    if (container && container.children.length === 0) {
                        location.reload(); // Recargar para mostrar el mensaje de "no hay favoritos"
                    }
                }, 300);
            }
        })
        .catch(error => {
            console.error('Error al quitar favorito:', error);
            alert('No se pudo cambiar el estado de favorito.');
        });
    }
    </script>
    @endpush
