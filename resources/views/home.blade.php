@extends('layouts.home')

@section('content')

@if(auth()->user()->type === 'company')

    {{-- Home para empresa --}}
    @if(session('success'))
        <div class="max-w-xl mx-auto mt-6 animate-fade-in-up">
            <div class="bg-gradient-success text-white px-6 py-4 rounded-xl shadow-soft">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <main class="container mx-auto py-8 px-6">
        <!-- Patrón decorativo de fondo -->
        <div class="decorative-pattern fixed inset-0 pointer-events-none"></div>
        
        <section class="relative gradient-primary text-white rounded-2xl p-8 mb-8 overflow-hidden animate-fade-in-up">
            <!-- Elementos decorativos -->
            <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full -mr-24 -mt-24"></div>
            <div class="absolute bottom-0 left-0 w-36 h-36 bg-white opacity-5 rounded-full -ml-18 -mb-18"></div>
            
            <div class="max-w-2xl mx-auto text-center relative z-10">
                <div class="mb-4">
                    <i class="fas fa-briefcase text-4xl mb-3 opacity-90"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold mb-4 leading-tight">
                    Gestiona tus ofertas laborales
                </h1>
                <p class="text-lg mb-6 opacity-90 leading-relaxed">
                    Encuentra los mejores talentos para tu empresa
                </p>
                <div class="flex flex-col md:flex-row gap-3 justify-center">
                    <a href="{{ route('job-offers.create') }}" class="btn-primary text-white px-6 py-3 rounded-xl font-semibold hover-lift shadow-soft">
                        <i class="fas fa-plus mr-2"></i>
                        Publicar Nueva Oferta
                    </a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 animate-slide-in">
            <div class="stat-card hover-lift">
                <div class="text-center">
                    <div class="text-4xl font-bold bg-gradient-to-r from-blue-800 to-gray-700 bg-clip-text text-transparent mb-2">12</div>
                    <div class="text-gray-600 font-medium">Ofertas Activas</div>
                    <div class="mt-2">
                        <i class="fas fa-chart-line text-blue-800"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card hover-lift">
                <div class="text-center">
                    <div class="text-4xl font-bold bg-gradient-to-r from-gray-700 to-blue-800 bg-clip-text text-transparent mb-2">136</div>
                    <div class="text-gray-600 font-medium">Aplicaciones Recibidas</div>
                    <div class="mt-2">
                        <i class="fas fa-users text-gray-700"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card hover-lift">
                <div class="text-center">
                    <div class="text-4xl font-bold bg-gradient-to-r from-blue-900 to-gray-800 bg-clip-text text-transparent mb-2">8</div>
                    <div class="text-gray-600 font-medium">Entrevistas Programadas</div>
                    <div class="mt-2">
                        <i class="fas fa-calendar-check text-blue-900"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card hover-lift">
                <div class="text-center">
                    <div class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-gray-900 bg-clip-text text-transparent mb-2">85%</div>
                    <div class="text-gray-600 font-medium">Tasa de Respuesta</div>
                    <div class="mt-2">
                        <i class="fas fa-percentage text-gray-800"></i>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Acciones Rápidas</h2>
                <div class="divider-gradient"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="{{ route('job-offers.create') }}" class="group">
                    <div class="card-enhanced hover-lift p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 gradient-primary rounded-full flex items-center justify-center mb-4 icon-bounce">
                            <i class="fas fa-file-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 group-hover:text-blue-800 transition-colors">Publicar Oferta</h3>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Crea y publica una nueva oferta laboral</p>
                        <span class="badge-primary">Crear ahora</span>
                    </div>
                </a>
                <div class="group cursor-not-allowed">
                    <div class="card-enhanced p-6 flex flex-col items-center text-center opacity-60">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-users text-2xl text-gray-500"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 text-gray-500">Gestionar Candidatos</h3>
                        <p class="text-sm text-gray-500 mb-4">Funcionalidad no implementada</p>
                        <span class="bg-gray-300 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Próximamente</span>
                    </div>
                </div>
                <div class="group cursor-not-allowed">
                    <div class="card-enhanced p-6 flex flex-col items-center text-center opacity-60">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-chart-line text-2xl text-gray-500"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 text-gray-500">Ver Estadísticas</h3>
                        <p class="text-sm text-gray-500 mb-4">Funcionalidad no implementada</p>
                        <span class="bg-gray-300 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Próximamente</span>
                    </div>
                </div>
                <div class="group cursor-not-allowed">
                    <div class="card-enhanced p-6 flex flex-col items-center text-center opacity-60">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-search text-2xl text-gray-500"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 text-gray-500">Buscar Talentos</h3>
                        <p class="text-sm text-gray-500 mb-4">Funcionalidad no implementada</p>
                        <span class="bg-gray-300 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Próximamente</span>
                    </div>
                </div>
            </div>
        </section>

    </main>
@elseif(auth()->user()->type === 'unemployed')

    {{-- Home para desempleado --}}
    <main class="container mx-auto py-8 px-6">
        <!-- Patrón decorativo de fondo -->
        <div class="decorative-pattern fixed inset-0 pointer-events-none"></div>

        <section class="relative gradient-secondary text-white rounded-2xl p-8 mb-8 overflow-hidden animate-fade-in-up">
            <!-- Elementos decorativos -->
            <div class="absolute top-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full -mr-24 -mt-24"></div>
            <div class="absolute bottom-0 left-0 w-36 h-36 bg-white opacity-5 rounded-full -ml-18 -mb-18"></div>
            
            <div class="max-w-2xl mx-auto text-center relative z-10">
                <div class="mb-4">
                    <i class="fas fa-rocket text-4xl mb-3 opacity-90"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold mb-4 leading-tight">
                    Tu próxima oportunidad laboral
                </h1>
                <p class="text-lg mb-6 opacity-90 leading-relaxed">
                    Conectamos talento con empresas
                </p>
                <div class="flex flex-col md:flex-row gap-3 justify-center">
                    <a href="{{ route('job-offers.index') }}" class="btn-secondary text-white px-6 py-3 rounded-xl font-semibold hover-lift shadow-soft">
                        <i class="fas fa-search mr-2"></i>
                        Buscar Empleos
                    </a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 animate-slide-in">
            <div class="stat-card hover-lift">
                <div class="text-center">
                    <div class="text-4xl font-bold bg-gradient-to-r from-blue-800 to-gray-700 bg-clip-text text-transparent mb-2">5,000+</div>
                    <div class="text-gray-600 font-medium">Empleos Disponibles</div>
                    <div class="mt-2">
                        <i class="fas fa-briefcase text-blue-800"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card hover-lift">
                <div class="text-center">
                    <div class="text-4xl font-bold bg-gradient-to-r from-gray-700 to-blue-800 bg-clip-text text-transparent mb-2">2,500+</div>
                    <div class="text-gray-600 font-medium">Empresas Registradas</div>
                    <div class="mt-2">
                        <i class="fas fa-building text-gray-700"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card hover-lift">
                <div class="text-center">
                    <div class="text-4xl font-bold bg-gradient-to-r from-blue-900 to-gray-800 bg-clip-text text-transparent mb-2">75%</div>
                    <div class="text-gray-600 font-medium">Tasa de Colocación</div>
                    <div class="mt-2">
                        <i class="fas fa-chart-line text-blue-900"></i>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Acciones Rápidas</h2>
                <div class="divider-gradient"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group cursor-not-allowed">
                    <div class="card-enhanced p-6 flex flex-col items-center text-center opacity-60">
                        <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-user-edit text-2xl text-gray-500"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 text-gray-500">Editar Perfil</h3>
                        <p class="text-sm text-gray-500 mb-4">Funcionalidad no implementada</p>
                        <span class="bg-gray-300 text-gray-600 px-3 py-1 rounded-full text-xs font-medium">Próximamente</span>
                    </div>
                </div>
                <a href="{{ route('portfolios.index') }}" class="group">
                    <div class="card-enhanced hover-lift p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 gradient-warning rounded-full flex items-center justify-center mb-4 icon-bounce">
                            <i class="fas fa-briefcase text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 group-hover:text-blue-800 transition-colors">Portafolio</h3>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Gestiona tus proyectos y logros</p>
                        <span class="badge-secondary">Ver portafolio</span>
                    </div>
                </a>
                <a href="{{ route('job-offers.index') }}" class="group">
                    <div class="card-enhanced hover-lift p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 gradient-success rounded-full flex items-center justify-center mb-4 icon-bounce">
                            <i class="fas fa-search text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 group-hover:text-blue-800 transition-colors">Buscar Empleos</h3>
                        <p class="text-sm text-gray-600 mb-4 leading-relaxed">Encuentra ofertas que se ajusten a ti</p>
                        <span class="badge-primary">Buscar ahora</span>
                    </div>
                </a>
            </div>
        </section>

    </main>

@else

    <p class="text-center text-red-600 mt-20 font-semibold">Tipo de usuario desconocido.</p>

@endif

@endsection
