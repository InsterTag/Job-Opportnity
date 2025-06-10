@extends('layouts.home')

@section('content')

@if(auth()->user()->type === 'company')

    {{-- Home para empresa --}}
    @if(session('success'))
        <div class="max-w-xl mx-auto mt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="container mx-auto py-8 px-6">

        <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-xl p-12 mb-12">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Gestiona tus ofertas laborales</h1>
                <p class="text-xl mb-8">Encuentra los mejores talentos para tu empresa de manera rápida y eficiente</p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="{{ route('job-offers.create') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Publicar Nueva Oferta
                    </a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">12</div>
                <div class="text-gray-600">Ofertas Activas</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">136</div>
                <div class="text-gray-600">Aplicaciones Recibidas</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">8</div>
                <div class="text-gray-600">Entrevistas Programadas</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">85%</div>
                <div class="text-gray-600">Tasa de Respuesta</div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <a href="{{ route('job-offers.create') }}" class="group">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center">
                        <div class="text-3xl text-blue-600 mb-3">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="font-semibold text-lg mb-2 group-hover:text-blue-600">Publicar Oferta</h3>
                        <p class="text-sm text-gray-600 mb-4">Crea y publica una nueva oferta laboral</p>
                        <span class="text-blue-600 text-sm font-medium">Crear ahora</span>
                    </div>
                </a>
                <a href="#" class="group">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center cursor-not-allowed opacity-50">
                        <i class="fas fa-users text-3xl text-blue-600 mb-3"></i>
                        <h3 class="font-semibold text-lg mb-2">Gestionar Candidatos</h3>
                        <p class="text-sm text-gray-600 mb-4">Funcionalidad no implementada</p>
                        <span class="text-blue-600 text-sm font-medium">Próximamente</span>
                    </div>
                </a>
                <a href="#" class="group">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center cursor-not-allowed opacity-50">
                        <i class="fas fa-chart-line text-3xl text-blue-600 mb-3"></i>
                        <h3 class="font-semibold text-lg mb-2">Ver Estadísticas</h3>
                        <p class="text-sm text-gray-600 mb-4">Funcionalidad no implementada</p>
                        <span class="text-blue-600 text-sm font-medium">Próximamente</span>
                    </div>
                </a>
                <a href="#" class="group">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center cursor-not-allowed opacity-50">
                        <i class="fas fa-search text-3xl text-blue-600 mb-3"></i>
                        <h3 class="font-semibold text-lg mb-2">Buscar Talentos</h3>
                        <p class="text-sm text-gray-600 mb-4">Funcionalidad no implementada</p>
                        <span class="text-blue-600 text-sm font-medium">Próximamente</span>
                    </div>
                </a>
            </div>
        </section>

    </main>
@elseif(auth()->user()->type === 'unemployed')

    {{-- Home para desempleado --}}
    <main class="container mx-auto py-8 px-6">

        <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-xl p-12 mb-12">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Encuentra tu próxima oportunidad laboral</h1>
                <p class="text-xl mb-8">Conectamos talento con las mejores empresas</p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="{{ route('job-offers.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Buscar Empleos
                    </a>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">5,000+</div>
                <div class="text-gray-600">Empleos Disponibles</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">2,500+</div>
                <div class="text-gray-600">Empresas Registradas</div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">75%</div>
                <div class="text-gray-600">Tasa de Colocación</div>
            </div>
        </section>

        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="#" class="group cursor-not-allowed opacity-50">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center">
                        <i class="fas fa-user-edit text-3xl text-blue-600 mb-3"></i>
                        <h3 class="font-semibold text-lg mb-2">Editar Perfil</h3>
                        <p class="text-sm text-gray-600 mb-4">Funcionalidad no implementada</p>
                        <span class="text-blue-600 text-sm font-medium">Próximamente</span>
                    </div>
                </a>
                <a href="{{ route('portfolios.index') }}" class="group">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center">
                        <i class="fas fa-briefcase text-3xl text-blue-600 mb-3"></i>
                        <h3 class="font-semibold text-lg mb-2">Portafolio</h3>
                        <p class="text-sm text-gray-600 mb-4">Gestiona tus proyectos y logros</p>
                        <span class="text-blue-600 text-sm font-medium">Ver portafolio</span>
                    </div>
                </a>
                <a href="{{ route('job-offers.index') }}" class="group">
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow flex flex-col items-center text-center">
                        <i class="fas fa-search text-3xl text-blue-600 mb-3"></i>
                        <h3 class="font-semibold text-lg mb-2">Buscar Empleos</h3>
                        <p class="text-sm text-gray-600 mb-4">Encuentra ofertas que se ajusten a ti</p>
                        <span class="text-blue-600 text-sm font-medium">Buscar ahora</span>
                    </div>
                </a>
            </div>
        </section>

    </main>

@else

    <p class="text-center text-red-600 mt-20 font-semibold">Tipo de usuario desconocido.</p>

@endif

@endsection
