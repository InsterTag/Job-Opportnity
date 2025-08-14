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
                        Mis Portafolios
                    </h1>
                    <p class="text-gray-600">Muestra tus proyectos y logros profesionales</p>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('portfolio-form') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift flex items-center shadow-soft">
                        <i class="fas fa-plus mr-2"></i>
                        Agregar Portafolio
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 animate-slide-in">
        @forelse($portfolios as $portfolio)
            <div class="card-enhanced hover-lift p-6">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">
                                    <i class="fas fa-folder-open text-blue-700 mr-2"></i>
                                    {{ $portfolio->title }}
                                </h2>
                                <p class="text-gray-600 mb-4 leading-relaxed">{{ $portfolio->description }}</p>
                                
                                <div class="flex items-center space-x-4 mb-4">
                                    @if($portfolio->url_proyect)
                                        <a href="{{ $portfolio->url_proyect }}" target="_blank" 
                                           class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-globe mr-1"></i>
                                            Ver Proyecto
                                        </a>
                                    @endif
                                    
                                    @if($portfolio->url_pdf)
                                        <a href="{{ asset('storage/portfolios/' . $portfolio->url_pdf) }}" target="_blank"
                                           class="flex items-center text-purple-600 hover:text-purple-800 transition-colors">
                                            <i class="fas fa-file-pdf mr-1"></i>
                                            Ver PDF
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end">
                        <div class="flex space-x-2 mb-3">
                            <a href="{{ route('edit-portfolio', $portfolio->id) }}" 
                               class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-4 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                <i class="fas fa-edit mr-1"></i>
                                Editar
                            </a>
                            <form action="{{ route('delete-portfolio', $portfolio->id) }}" method="POST" 
                                  style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este portafolio?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-gradient-to-r from-red-800 to-red-900 text-white px-4 py-2 rounded-xl hover-lift transition-all duration-300 text-sm font-medium shadow-soft">
                                    <i class="fas fa-trash mr-1"></i>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card-enhanced p-12 text-center animate-fade-in-up">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-briefcase text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No tienes portafolios aún</h3>
                <p class="text-gray-600 mb-6">Comienza a mostrar tus proyectos y logros profesionales.</p>
                <a href="{{ route('portfolio-form') }}" class="btn-primary text-white px-6 py-3 rounded-xl hover-lift inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Crear Primer Portafolio
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
