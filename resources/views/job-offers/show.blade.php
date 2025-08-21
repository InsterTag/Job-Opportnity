@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Navegación -->
    <div class="mb-6">
        <a href="{{ route('job-offers.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver a ofertas laborales
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Información principal -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $jobOffer->title }}</h1>
                        <div class="flex items-center text-gray-600 mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h3M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="text-lg font-semibold">{{ $jobOffer->company->name }}</span>
                        </div>
                        <div class="flex items-center text-gray-500 mb-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $jobOffer->location }}</span>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Publicado {{ $jobOffer->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Acciones y formulario de postulación -->
                    <div class="flex flex-col items-end space-y-2">
                        @if(auth()->user()?->unemployed)
                            <button onclick="toggleFavorite(this, 'joboffer', {{ $jobOffer->id }})"
                                class="favorite-btn w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover-lift {{ $isFavorite ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-400 hover:bg-blue-50 hover:text-blue-700' }}">
                                <i class="fas fa-heart text-lg"></i>
                            </button>

                            {{-- Formulario de postulación movido al sidebar --}}
                        @endif

                        @if(auth()->user()?->isCompany() && auth()->user()->company->id === $jobOffer->company_id)
                            <div class="flex space-x-2">
                                <a href="{{ route('job-offers.edit', $jobOffer->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors">
                                    Editar
                                </a>
                                <form action="{{ route('job-offers.destroy', $jobOffer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro que deseas eliminar esta oferta laboral?')">
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
                @if($jobOffer->categories->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Categorías</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($jobOffer->categories as $category)
                                <span class="inline-block bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm font-semibold">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Descripción -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Descripción del puesto</h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($jobOffer->description)) !!}
                    </div>
                </div>

                <!-- Mapa -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Ubicación</h3>
                    <div id="map" class="w-full h-64 rounded-lg border"></div>
                    @if(!$jobOffer->geolocation)
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
            <!-- Información de la empresa -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Información de la empresa</h3>
                <div class="space-y-3">
                    <div>
                        <span class="font-medium text-gray-700">Empresa:</span>
                        <p class="text-gray-600">{{ $jobOffer->company->name }}</p>
                    </div>
                    @if($jobOffer->company->business_name)
                        <div>
                            <span class="font-medium text-gray-700">Razón social:</span>
                            <p class="text-gray-600">{{ $jobOffer->company->business_name }}</p>
                        </div>
                    @endif
                    @if($jobOffer->company->description)
                        <div>
                            <span class="font-medium text-gray-700">Descripción:</span>
                            <p class="text-gray-600">{{ Str::limit($jobOffer->company->description, 150) }}</p>
                        </div>
                    @endif
                    @if($jobOffer->company->website)
                        <div>
                            <span class="font-medium text-gray-700">Sitio web:</span>
                            <a href="{{ $jobOffer->company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                {{ $jobOffer->company->website }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Detalles del trabajo -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detalles del trabajo</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Salario:</span>
                        <span class="text-green-600 font-semibold">{{ $jobOffer->salary_formatted }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Ubicación:</span>
                        <span class="text-gray-600">{{ $jobOffer->location }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Publicado:</span>
                        <span class="text-gray-600">{{ $jobOffer->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de aplicar (solo visible para cesantes) -->
            @if(auth()->user()?->unemployed)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Aplicar a esta oferta</h3>

                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-2 rounded mb-2">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 text-red-800 p-2 rounded mb-2">{{ session('error') }}</div>
                    @endif

                    @php
                        $existingApplication = $jobOffer->applications()->where('unemployed_id', auth()->user()->unemployed->id)->first();
                    @endphp

                    @if($existingApplication)
                        <div class="mb-4">
                            <div class="gradient-primary rounded-lg p-4 md:p-5 shadow-md overflow-hidden">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center bg-white/10 flex-shrink-0">
                                        <i class="fas fa-check text-white text-lg"></i>
                                    </div>
                                    <div class="flex-1 text-white">
                                        <p class="font-semibold text-white leading-tight">Ya has postulado a esta oferta.</p>
                                        @if($existingApplication->cv_url)
                                            <a href="{{ $existingApplication->cv_url }}" target="_blank" class="inline-block mt-1 text-white/90 underline hover:text-white">Ver CV subido</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('job-applications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            <input type="hidden" name="unemployed_id" value="{{ auth()->user()->unemployed->id }}">
                            <input type="hidden" name="job_offer_id" value="{{ $jobOffer->id }}">
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Mensaje (opcional)</label>
                                <textarea name="message" id="message" rows="3" maxlength="2000" class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2"></textarea>
                            </div>
                            <div>
                                <label for="cv" class="block text-sm font-medium text-gray-700">CV (opcional, PDF/DOC/DOCX, máx. 5MB)</label>
                                <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" class="mt-1 block w-full border border-gray-200 rounded px-2 py-1">
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors font-semibold">Postularme a esta oferta</button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
    
    @if($jobOffer->geolocation)
        // Si hay geolocalización específica, intentar usarla
        try {
            const coords = "{{ $jobOffer->geolocation }}".split(',');
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
            <h3 class="font-semibold text-gray-800">{{ $jobOffer->title }}</h3>
            <p class="text-gray-600">{{ $jobOffer->company->name }}</p>
            <p class="text-sm text-gray-500">{{ $jobOffer->location }}</p>
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