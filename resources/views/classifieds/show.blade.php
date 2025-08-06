@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header mejorado -->
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-6">
            <div class="flex items-center justify-between">
                <a href="{{ route('classifieds.index') }}" class="btn-secondary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver a clasificados
                </a>
                
                <!-- Botón de favoritos -->
                @auth
                    @if(auth()->user()->unemployed)
                        @php
                            $isOwner = auth()->user()->unemployed->id === $classified->unemployed_id;
                        @endphp
                        
                        @if(!$isOwner)
                            <button onclick="toggleFavorite(this, 'classified', {{ $classified->id }})"
                                    class="favorite-btn w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover-lift {{ $isFavorite ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-400 hover:bg-blue-50 hover:text-blue-700' }}">
                                <i class="fas fa-heart text-lg"></i>
                            </button>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información principal -->
        <div class="lg:col-span-2">
            <div class="card-enhanced p-8 mb-6 animate-fade-in-up">
                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            <i class="fas fa-bullhorn text-blue-700 mr-3"></i>
                            {{ $classified->title }}
                        </h1>
                        
                        <div class="flex items-center mb-4">
                            @if($classified->company)
                                <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-building text-white"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-800">{{ $classified->company->business_name ?? $classified->company->name }}</p>
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Empresa verificada</span>
                                </div>
                            @elseif($classified->unemployed)
                                <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-800">{{ $classified->unemployed->name }}</p>
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Usuario individual</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-700 mr-2"></i>
                                <span>{{ $classified->location }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-gray-600 mr-2"></i>
                                <span>Publicado {{ $classified->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="flex flex-col items-end space-y-2">
                        @if(auth()->user()?->unemployed)
                            @php
                                $isOwner = auth()->user()->unemployed->id === $classified->unemployed_id;
                            @endphp
                            
                            @if(!$isOwner)
                                <button onclick="toggleFavorite(this, 'classified', {{ $classified->id }})"
                                    class="favorite-btn w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover-lift {{ $isFavorite ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-400 hover:bg-blue-50 hover:text-blue-700' }}">
                                    <i class="fas fa-heart text-lg"></i>
                                </button>
                            @endif
                        @endif

                        @php
                            $canEdit = (auth()->user()?->company && auth()->user()->company->id === $classified->company_id) ||
                                      (auth()->user()?->unemployed && auth()->user()->unemployed->id === $classified->unemployed_id);
                        @endphp

                        @if($canEdit)
                            <div class="flex space-x-2">
                                <a href="{{ route('classifieds.edit', $classified->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                                    Editar
                                </a>
                                <form action="{{ route('classifieds.destroy', $classified->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar este clasificado?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Categorías -->
                @if($classified->categories->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Categorías</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($classified->categories as $category)
                                <span class="inline-block bg-purple-100 text-purple-800 rounded-full px-3 py-1 text-sm font-semibold">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Descripción -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Descripción</h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($classified->description)) !!}
                    </div>
                </div>

                <!-- Mapa -->
                <div class="mb-6 relative overflow-hidden">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Ubicación</h3>
                    <div class="relative overflow-hidden rounded-lg border" style="height: 256px;">
                        <div id="map" class="w-full h-64 rounded-lg border absolute inset-0" style="height: 256px !important;"></div>
                    </div>
                    @if(!$classified->geolocation)
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Mostrando ubicación aproximada de Popayán (coordenadas específicas no disponibles)
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Información del publicador -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del publicador</h3>
                <div class="space-y-3">
                    @if($classified->company)
                        <div>
                            <span class="font-medium text-gray-700">Empresa:</span>
                            <p class="text-gray-600">{{ $classified->company->name }}</p>
                        </div>
                        @if($classified->company->business_name)
                            <div>
                                <span class="font-medium text-gray-700">Razón social:</span>
                                <p class="text-gray-600">{{ $classified->company->business_name }}</p>
                            </div>
                        @endif
                        @if($classified->company->description)
                            <div>
                                <span class="font-medium text-gray-700">Descripción:</span>
                                <p class="text-gray-600">{{ Str::limit($classified->company->description, 150) }}</p>
                            </div>
                        @endif
                        @if($classified->company->website)
                            <div>
                                <span class="font-medium text-gray-700">Sitio web:</span>
                                <a href="{{ $classified->company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $classified->company->website }}
                                </a>
                            </div>
                        @endif
                    @elseif($classified->unemployed)
                        <div>
                            <span class="font-medium text-gray-700">Nombre:</span>
                            <p class="text-gray-600">{{ $classified->unemployed->name }}</p>
                        </div>
                        @if($classified->unemployed->email)
                            <div>
                                <span class="font-medium text-gray-700">Email:</span>
                                <p class="text-gray-600">{{ $classified->unemployed->email }}</p>
                            </div>
                        @endif
                        @if($classified->unemployed->phone)
                            <div>
                                <span class="font-medium text-gray-700">Teléfono:</span>
                                <p class="text-gray-600">{{ $classified->unemployed->phone }}</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Detalles del clasificado -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detalles</h3>
                <div class="space-y-3">
                    @if($classified->salary)
                        <div class="flex justify-between">
                            <span class="font-medium text-gray-700">Precio/Salario:</span>
                            <span class="text-green-600 font-semibold">${{ number_format($classified->salary, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Ubicación:</span>
                        <span class="text-gray-600">{{ $classified->location }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Publicado:</span>
                        <span class="text-gray-600">{{ $classified->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Tipo:</span>
                        <span class="text-gray-600">
                            @if($classified->company)
                                Empresa
                            @else
                                Particular
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Botón de contacto -->
            @if(auth()->check())
                @php
                    $canContact = !((auth()->user()?->company && auth()->user()->company->id === $classified->company_id) ||
                                   (auth()->user()?->unemployed && auth()->user()->unemployed->id === $classified->unemployed_id));
                @endphp
                
                @if($canContact)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <a href="{{ route('message-form') }}?to={{ $classified->company ? 'company_' . $classified->company_id : 'unemployed_' . $classified->unemployed_id }}" 
                           class="w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition-colors font-semibold text-center block">
                            Contactar
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
/* Fijar z-index del mapa para que no tape la navegación */
.leaflet-container {
    z-index: 1 !important;
    position: relative !important;
    max-height: 256px !important;
}

.leaflet-control-container {
    z-index: 2 !important;
}

.leaflet-popup {
    z-index: 3 !important;
}

.leaflet-overlay-pane {
    z-index: 1 !important;
}

.leaflet-map-pane {
    z-index: 1 !important;
}

/* Asegurar que el header tenga un z-index más alto */
.header-glass {
    z-index: 1000 !important;
    position: sticky !important;
    top: 0 !important;
}

/* Fix para dropdowns del header */
#userDropdownMenu,
#notificationPanel {
    z-index: 1001 !important;
    position: absolute !important;
}

/* Contenedor del mapa - limitar su área */
#map {
    position: relative !important;
    z-index: 1 !important;
    height: 256px !important;
    max-height: 256px !important;
    overflow: hidden !important;
    border-radius: 8px !important;
}

/* Asegurar que todo el contenido del mapa se mantenga dentro del contenedor */
#map * {
    max-height: 256px !important;
}

/* Específicamente para evitar que el mapa se expanda */
.leaflet-container,
.leaflet-container * {
    box-sizing: border-box !important;
}

/* Contenedor principal para evitar desbordamiento */
.container {
    position: relative;
    z-index: auto;
}

/* Asegurar que el header siempre esté visible */
header {
    z-index: 1000 !important;
    position: sticky !important;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(10px) !important;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
let map;
let marker;

function initMap() {
    // Coordenadas fijas de Popayán, Cauca, Colombia
    let lat = 2.4448;
    let lng = -76.6147;
    
    @if($classified->geolocation)
        // Si hay geolocalización específica, intentar usarla
        try {
            const coords = "{{ $classified->geolocation }}".split(',');
            const parsedLat = parseFloat(coords[0]);
            const parsedLng = parseFloat(coords[1]);
            
            // Solo usar las coordenadas si son válidas
            if (!isNaN(parsedLat) && !isNaN(parsedLng) && parsedLat !== 0 && parsedLng !== 0) {
                lat = parsedLat;
                lng = parsedLng;
            }
        } catch (e) {
            console.log('Error parsing coordinates, using Popayán default');
        }
    @endif

    console.log('Initializing map with coordinates:', lat, lng);

    // Inicializar el mapa con Leaflet
    map = L.map('map').setView([lat, lng], 15);

    // Agregar tiles de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Crear marcador
    marker = L.marker([lat, lng]).addTo(map);

    // Crear popup con información
    const popupContent = `
        <div class="p-2">
            <h3 class="font-semibold text-gray-800">{{ $classified->title }}</h3>
            @if($classified->company)
                <p class="text-gray-600">{{ $classified->company->name }}</p>
            @elseif($classified->unemployed)
                <p class="text-gray-600">{{ $classified->unemployed->name }}</p>
            @endif
            <p class="text-sm text-gray-500">{{ $classified->location }}</p>
            <p class="text-xs text-blue-500">Coords: ${lat}, ${lng}</p>
        </div>
    `;

    marker.bindPopup(popupContent).openPopup();
}

// Inicializar el mapa cuando se carga la página
document.addEventListener('DOMContentLoaded', function() {
    initMap();
});

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