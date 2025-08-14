    @extends('layouts.home')

    @section('content')
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-100">
        <div class="container mx-auto px-4 py-12">
            <!-- Header mejorado -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full mb-4">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.56L5.82 22L7 14.14l-5-4.87l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Mis Favoritos</h1>
                <p class="text-gray-600 text-lg">Todas tus oportunidades guardadas en un solo lugar</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-white text-gray-700 rounded-full shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver al inicio
                    </a>
                </div>
            </div>

        {{-- Sección Ofertas de Trabajo --}}
        <div class="mb-16">
            <div class="flex items-center mb-8">
                <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Ofertas de Trabajo</h2>
                    <p class="text-gray-600">Oportunidades laborales que te interesan</p>
                </div>
                <div class="ml-auto bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-semibold">
                    {{ count($favoriteJobOffers) }} favorita{{ count($favoriteJobOffers) == 1 ? '' : 's' }}
                </div>
            </div>

            @forelse($favoriteJobOffers as $jobOffer)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 mb-6 overflow-hidden border border-gray-100 hover:border-purple-200">
                    <a href="{{ route('job-offers.show', $jobOffer->id) }}" class="block p-8 hover:bg-gradient-to-r hover:from-purple-50 hover:to-transparent transition-all duration-300">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-purple-600 transition-colors duration-300">
                                        {{ $jobOffer->title }}
                                    </h3>
                                    <div class="ml-3 px-3 py-1 bg-purple-100 text-purple-600 text-xs font-medium rounded-full">
                                        Oferta Laboral
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 text-lg leading-relaxed mb-4">
                                    {{ Str::limit($jobOffer->description, 200) }}
                                </p>
                                
                                <div class="flex items-center space-x-6 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                        </svg>
                                        <span class="font-medium text-gray-700">{{ $jobOffer->company->name }}</span>
                                    </div>
                                    @if($jobOffer->categories->count() > 0)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.56L5.82 22L7 14.14l-5-4.87l6.91-1.01L12 2z"/>
                                            </svg>
                                            <span>{{ $jobOffer->categories->first()->name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <button onclick="toggleFavorite(this, 'joboffer', {{ $jobOffer->id }}, true)"
                                    class="ml-6 p-3 text-yellow-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-all duration-300 z-10 group" 
                                    title="Quitar de favoritos">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.56L5.82 22L7 14.14l-5-4.87l6.91-1.01L12 2z"/>
                                </svg>
                            </button>
                        </div>
                    </a>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6m8 0V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No tienes ofertas laborales favoritas</h3>
                    <p class="text-gray-500 mb-6">Explora oportunidades de trabajo y guarda las que más te interesen</p>
                    <a href="{{ route('job-offers.index') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition-colors duration-300">
                        Ver ofertas de trabajo
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Sección Clasificados --}}
        <div>
            <div class="flex items-center mb-8">
                <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Clasificados</h2>
                    <p class="text-gray-600">Anuncios y servicios que has guardado</p>
                </div>
                <div class="ml-auto bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                    {{ count($favoriteClassifieds) }} favorito{{ count($favoriteClassifieds) == 1 ? '' : 's' }}
                </div>
            </div>

            @forelse($favoriteClassifieds as $classified)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 mb-6 overflow-hidden border border-gray-100 hover:border-blue-200">
                    <a href="{{ route('classifieds.show', $classified->id) }}" class="block p-8 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-all duration-300">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors duration-300">
                                        {{ $classified->title }}
                                    </h3>
                                    <div class="ml-3 px-3 py-1 bg-blue-100 text-blue-600 text-xs font-medium rounded-full">
                                        Clasificado
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 text-lg leading-relaxed mb-4">
                                    {{ Str::limit($classified->description, 200) }}
                                </p>
                                
                                <div class="flex items-center space-x-6 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                        <span class="font-medium text-gray-700">{{ $classified->location }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.56L5.82 22L7 14.14l-5-4.87l6.91-1.01L12 2z"/>
                                        </svg>
                                        <span>
                                            {{ $classified->company?->name ?? $classified->unemployed?->name }}
                                        </span>
                                    </div>
                                    @if($classified->salary)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                                            </svg>
                                            <span>${{ number_format($classified->salary) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <button onclick="toggleFavorite(this, 'classified', {{ $classified->id }}, true)"
                                    class="ml-6 p-3 text-yellow-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-all duration-300 z-10 group" 
                                    title="Quitar de favoritos">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22L12 18.56L5.82 22L7 14.14l-5-4.87l6.91-1.01L12 2z"/>
                                </svg>
                            </button>
                        </div>
                    </a>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No tienes clasificados favoritos</h3>
                    <p class="text-gray-500 mb-6">Descubre anuncios y servicios interesantes para guardar</p>
                    <a href="{{ route('classifieds.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors duration-300">
                        Ver clasificados
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
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
