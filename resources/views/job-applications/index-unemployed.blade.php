@extends('layouts.home')
@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <header class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800">Mis postulaciones a ofertas</h1>
                <p class="mt-1 text-sm text-gray-500">Revisa el estado de tus postulaciones, descarga tu CV y gestiona entrevistas desde aquí.</p>
            </div>

            <form method="GET" class="flex items-center gap-3">
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Buscar por título o empresa" class="border rounded px-3 py-2 text-sm w-56" />
                <select name="status" class="border rounded px-3 py-2 text-sm">
                    <option value="">Todos los estados</option>
                    <option value="pending" @if(request('status')=='pending') selected @endif>Pendiente</option>
                    <option value="accepted" @if(request('status')=='accepted') selected @endif>Aceptada</option>
                    <option value="rejected" @if(request('status')=='rejected') selected @endif>Rechazada</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Filtrar</button>
            </form>
        </div>
    </header>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    @if($applications->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($applications as $application)
                @include('includes.job-application-card', ['application' => $application])
            @endforeach
        </div>

        <div class="mt-8">{{ $applications->withQueryString()->links() }}</div>
    @else
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <div class="text-4xl">🙌</div>
            <h3 class="mt-4 text-xl font-semibold text-gray-800">Aún no tienes postulaciones</h3>
            <p class="mt-2 text-sm text-gray-500">Explora ofertas y aplica a las que te interesen. Cuando te postules, aquí verás el estado y los horarios de entrevistas.</p>
            <div class="mt-4">
                <a href="{{ route('job-offers.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">Ver ofertas</a>
            </div>
        </div>
    @endif

</div>
@endsection
