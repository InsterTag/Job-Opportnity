@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header mejorado -->
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">
                        <i class="fas fa-bullhorn text-blue-800 mr-3"></i>
                        Clasificados
                    </h1>
                    <p class="text-gray-600">Encuentra anuncios y oportunidades de tu interés</p>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->unemployed)
                            <a href="{{ route('favorites.index') }}" class="btn-secondary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                                <i class="fas fa-heart mr-2"></i>
                                Mis Favoritos
                            </a>
                            <a href="{{ route('classifieds.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                                <i class="fas fa-plus mr-2"></i>
                                Crear Clasificado
                            </a>
                        @endif

                        @if(auth()->user()->company)
                            <a href="{{ route('classifieds.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                                <i class="fas fa-plus mr-2"></i>
                                Crear Clasificado
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Filtros mejorados --}}
    <div class="bg-white rounded-2xl shadow-soft p-6 mb-8 animate-fade-in-up">
        <form method="GET" action="{{ route('classifieds.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-blue-600 mr-1"></i>
                        Ubicación
                    </label>
                    <input type="text" name="location" id="location" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all duration-300" 
                           placeholder="Buscar por ubicación" 
                           value="{{ request('location') }}">
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag text-blue-600 mr-1"></i>
                        Categoría
                    </label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                        <option value="">Todas las categorías</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search text-blue-600 mr-1"></i>
                        Buscar
                    </label>
                    <input type="text" name="search" id="search" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all duration-300" 
                           placeholder="Buscar en título y descripción" 
                           value="{{ request('search') }}">
                </div>
                <div class="flex items-end">
                    <button type="submit" 
                            class="w-full btn-primary text-white px-6 py-3 rounded-xl hover-lift transition-all duration-300 shadow-soft">
                        <i class="fas fa-search mr-2"></i>
                        Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Clasificados con diseño moderno --}}
    <div class="grid grid-cols-1 gap-6 animate-slide-in">
        @forelse($classifieds as $classified)
            <div class="card-enhanced hover-lift p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    <a href="{{ route('classifieds.show', $classified->id) }}" class="hover:text-blue-800 transition-colors flex items-center group">
                                        <i class="fas fa-arrow-right text-blue-700 mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                        {{ $classified->title }}
                                    </a>
                                </h2>
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center mr-3">
                                        @if($classified->company)
                                            <i class="fas fa-building text-white"></i>
                                        @else
                                            <i class="fas fa-user text-white"></i>
                                        @endif
                                    </div>
                                    <div>
                                        @if($classified->company)
                                            <p class="text-gray-700 font-medium">{{ $classified->company->business_name ?? $classified->company->name }}</p>
                                            <p class="text-sm text-gray-500">Empresa verificada</p>
                                        @elseif($classified->unemployed)
                                            <p class="text-gray-700 font-medium">{{ $classified->unemployed->name }}</p>
                                            <p class="text-sm text-gray-500">Usuario individual</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="badge-primary">Clasificado</span>
                            </div>
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-700 mr-1"></i>
                                <span>{{ $classified->location }}</span>
                            </div>
                            @if($classified->salary)
                                <div class="flex items-center">
                                    <i class="fas fa-dollar-sign text-green-600 mr-1"></i>
                                    <span class="text-green-600 font-semibold">${{ number_format($classified->salary, 2) }}</span>
                                </div>
                            @endif
                            <div class="flex items-center">
                                <i class="fas fa-clock text-gray-600 mr-1"></i>
                                <span>{{ $classified->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            @foreach($classified->categories as $category)
                                <span class="inline-block bg-gradient-to-r from-gray-100 to-blue-100 text-gray-800 rounded-full px-3 py-1 text-sm font-medium mr-2 mb-2">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        <p class="text-gray-700 leading-relaxed">{{ Str::limit($classified->description, 200) }}</p>
                    </div>

                    <div class="text-right flex flex-col items-end">
                        <!-- Botón de favoritos mejorado -->
                        @auth
                            @if(auth()->user()->unemployed)
                                @php
                                    $isOwner = auth()->user()->unemployed->id === $classified->unemployed_id;
                                    $isFavorite = !$isOwner ? auth()->user()->unemployed->favoriteClassifieds->contains($classified) : false;
                                @endphp
                                
                                @if(!$isOwner)
                                    <button onclick="toggleFavorite(this, 'classified', {{ $classified->id }})"
                                        class="favorite-btn mb-4 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover-lift {{ $isFavorite ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-400 hover:bg-blue-50 hover:text-blue-700' }}">
                                        <i class="fas fa-heart text-lg"></i>
                                    </button>
                                @endif
                            @endif
                        @endauth

                        <!-- Información de precio/salario -->
                        @if($classified->salary)
                            <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-4 mb-4">
                                <p class="text-lg font-bold text-gray-800 mb-1">${{ number_format($classified->salary, 2) }}</p>
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $classified->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-4 mb-4">
                                <p class="text-sm font-medium text-gray-600 mb-1">Consultar precio</p>
                                <p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $classified->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endif

                        <!-- Botones de acción para propietarios -->
                        @auth
                            @php
                                $isOwner = (auth()->user()->company && auth()->user()->company->id === $classified->company_id)
                                        || (auth()->user()->unemployed && auth()->user()->unemployed->id === $classified->unemployed_id);
                            @endphp

                            @if($isOwner)
                                <div class="flex space-x-2 mb-3">
                                    <a href="{{ route('classifieds.edit', $classified->id) }}" 
                                       class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-4 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                        <i class="fas fa-edit mr-1"></i>
                                        Editar
                                    </a>
                                    <form action="{{ route('classifieds.destroy', $classified->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar este clasificado?')">
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
                        @endauth

                        <!-- Botón ver más -->
                        <a href="{{ route('classifieds.show', $classified->id) }}" 
                           class="btn-primary text-white px-6 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                            <i class="fas fa-eye mr-1"></i>
                            Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="card-enhanced p-12 text-center animate-fade-in-up">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bullhorn text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No se encontraron clasificados</h3>
                <p class="text-gray-600 mb-6">Actualmente no hay clasificados disponibles que coincidan con tus criterios.</p>
                @if(auth()->user()?->company || auth()->user()?->unemployed)
                    <a href="{{ route('classifieds.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift inline-flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Publicar Primer Clasificado
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
    @if($classifieds->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-xl shadow-soft p-4">
                {{ $classifieds->links() }}
            </div>
        </div>
    @endif
</div>
@endsection

<!-- Estilos adicionales para favoritos -->
<style>
.favorite-btn .star-filled,
.favorite-btn .star-outline {
    transition: all 0.3s ease;
}

.favorite-btn:hover {
    transform: scale(1.1);
}

.card-enhanced {
    transition: all 0.3s ease;
}

.card-enhanced:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style>

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
