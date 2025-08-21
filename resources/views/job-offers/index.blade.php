@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header mejorado -->
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-briefcase text-blue-800 mr-3"></i>
                        Ofertas de Trabajo
                    </h1>
                    <p class="text-gray-600">Descubre oportunidades que se adapten a tu perfil profesional</p>
                </div>
                <div class="flex items-center space-x-4">
                    @if(auth()->user()?->unemployed)
                        <a href="{{ route('favorites.index') }}" class="btn-secondary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                            <i class="fas fa-heart mr-2"></i>
                            Mis Favoritos
                        </a>
                    @endif

                    @if(auth()->user()?->isCompany())
                        <a href="{{ route('job-offers.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                            <i class="fas fa-plus mr-2"></i>
                            Crear Nueva Oferta
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Filtros mejorados aquí si los tienes --}}

    <div class="grid grid-cols-1 gap-6 animate-slide-in">
        @forelse($jobOffers as $jobOffer)
            <div class="card-enhanced hover-lift p-6">
                @php
                    $hasApplied = false;
                    if (auth()->check() && auth()->user()?->unemployed) {
                        try {
                            $hasApplied = $jobOffer->applications()->where('unemployed_id', auth()->user()->unemployed->id)->exists();
                        } catch (\Throwable $e) {
                            $hasApplied = false;
                        }
                    }
                @endphp
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    <a href="{{ route('job-offers.show', $jobOffer->id) }}" class="hover:text-blue-800 transition-colors flex items-center group">
                                        <i class="fas fa-arrow-right text-blue-700 mr-2 opacity-0 group-hover:opacity-100 transition-opacity transform transition-transform duration-200 -translate-x-1 group-hover:translate-x-0"></i>
                                        {{ $jobOffer->title }}
                                    </a>
                                </h2>
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-building text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-700 font-medium">{{ $jobOffer->company->name }}</p>
                                        <p class="text-sm text-gray-500">Empresa verificada</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="badge-primary">
                                    @if($jobOffer->offer_type === 'contract')
                                        Contrato
                                    @elseif($jobOffer->offer_type === 'classified')
                                        Clasificado
                                    @else
                                        {{ ucfirst($jobOffer->offer_type) }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-700 mr-1"></i>
                                <span>{{ $jobOffer->location }}</span>
                            </div>
                            @if($jobOffer->geolocation)
                                <div class="flex items-center">
                                    <i class="fas fa-globe text-gray-700 mr-1"></i>
                                    <span>Ver en mapa</span>
                                </div>
                            @endif
                            <div class="flex items-center">
                                <i class="fas fa-clock text-gray-600 mr-1"></i>
                                <span>{{ $jobOffer->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            @foreach($jobOffer->categories as $category)
                                <span class="inline-block bg-gradient-to-r from-gray-100 to-blue-100 text-gray-800 rounded-full px-3 py-1 text-sm font-medium mr-2 mb-2">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end">
                        <!-- Botón de favoritos mejorado -->
                        @if(auth()->user()?->unemployed)
                            @php
                                $isFavorite = auth()->user()->unemployed->favoriteJobOffers->contains($jobOffer);
                            @endphp
                            <button onclick="toggleFavorite(this, 'joboffer', {{ $jobOffer->id }})"
                                class="favorite-btn mb-4 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover-lift {{ $isFavorite ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-400 hover:bg-blue-50 hover:text-blue-700' }}">
                                <i class="fas {{ $isFavorite ? 'fa-heart' : 'fa-heart' }} text-lg"></i>
                            </button>
                        @endif

                        <!-- Información de salario mejorada -->
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-4 mb-4">
                            <p class="text-lg font-bold text-gray-800 mb-1">{{ $jobOffer->salary_formatted }}</p>
                            <p class="text-xs text-gray-500 flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $jobOffer->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <!-- Botones de acción para empresas -->
                        @if(auth()->user()?->isCompany())
                            <div class="flex space-x-2">
                                <a href="{{ route('job-offers.edit', $jobOffer->id) }}" 
                                   class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-4 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                    <i class="fas fa-edit mr-1"></i>
                                    Editar
                                </a>
                                <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta oferta laboral?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-gradient-to-r from-red-800 to-red-900 text-white px-4 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                        <i class="fas fa-trash mr-1"></i>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif

                        <!-- Si ya aplicó, mostrar botón deshabilitado con mismo estilo; si no, mostrar Ver Detalles -->
                        @if(auth()->check() && auth()->user()?->unemployed && $hasApplied)
                            <button disabled class="mt-3 btn-primary text-white px-6 py-2 rounded-xl transition-all duration-300 text-sm font-medium shadow-soft w-full flex items-center justify-center pointer-events-none cursor-not-allowed">
                                <i class="fas fa-check mr-2"></i>
                                Ya te postulaste
                            </button>
                        @else
                            <a href="{{ route('job-offers.show', $jobOffer->id) }}" 
                               class="mt-3 btn-primary text-white px-6 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                <i class="fas fa-eye mr-1"></i>
                                Ver Detalles
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="card-enhanced p-12 text-center animate-fade-in-up">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No se encontraron ofertas</h3>
                <p class="text-gray-600 mb-6">Actualmente no hay ofertas de trabajo disponibles que coincidan con tus criterios.</p>
                @if(auth()->user()?->isCompany())
                    <a href="{{ route('job-offers.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Publicar Primera Oferta
                    </a>
                @else
                    <button onclick="location.reload()" class="btn-secondary text-white px-6 py-3 rounded-xl hover-lift inline-flex items-center">
                        <i class="fas fa-refresh mr-2"></i>
                        Actualizar Lista
                    </button>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Paginación mejorada -->
    @if($jobOffers->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-xl shadow-soft p-4">
                {{ $jobOffers->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Estilos adicionales para favoritos -->
<style>
.favorite-btn .star-filled,
.favorite-btn .star-outline {
    transition: all 0.3s ease;
}

.favorite-btn:hover {
    transform: scale(1.1);
}
</style>
@endsection

@push('scripts')
<script>
function toggleFavorite(button, type, id) {
    // Mostrar estado de carga
    button.style.opacity = '0.5';
    button.style.pointerEvents = 'none';
    
    fetch("{{ route('favorites.toggle') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ type, id }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            throw new Error(data.error);
        }
        
        // Actualizar estado visual
        if (data.isFavorite) {
            button.classList.remove('bg-gray-100', 'text-gray-400', 'hover:bg-blue-50', 'hover:text-blue-700');
            button.classList.add('bg-blue-100', 'text-blue-800');
        } else {
            button.classList.remove('bg-blue-100', 'text-blue-800');
            button.classList.add('bg-gray-100', 'text-gray-400', 'hover:bg-blue-50', 'hover:text-blue-700');
        }
    })
    .catch(error => {
        console.error('Error al cambiar favorito:', error);
        
        // Mostrar mensaje de error específico
        if (error.message.includes('403')) {
            alert('Solo los candidatos pueden marcar favoritos.');
        } else if (error.message.includes('404')) {
            alert('El elemento no fue encontrado.');
        } else {
            alert('No se pudo cambiar el estado de favorito. Por favor, inténtalo de nuevo.');
        }
    })
    .finally(() => {
        // Restaurar estado del botón
        button.style.opacity = '1';
        button.style.pointerEvents = 'auto';
    });
}
</script>
@endpush
