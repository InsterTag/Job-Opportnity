@extends('layouts.home')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-white to-gray-50 p-6 border-b">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-800">Postulaciones a mis ofertas</h1>
                    <p class="text-gray-500 mt-1">Revisa, filtra y responde a las postulaciones en un solo lugar.</p>
                </div>

                <div class="flex items-center gap-3 flex-wrap">
                    <div class="px-4 py-3 bg-blue-600 text-white rounded-xl shadow-md text-center">
                        <div class="text-sm opacity-90">Total</div>
                        <div class="text-2xl font-bold">{{ $totalCount ?? $applications->total() }}</div>
                    </div>

                    <div class="px-3 py-2 bg-white rounded-lg shadow-sm text-center">
                        <div class="text-sm text-gray-500">Pendientes</div>
                        <div class="text-lg font-semibold">{{ $pendingCount ?? 0 }}</div>
                    </div>
                    <div class="px-3 py-2 bg-white rounded-lg shadow-sm text-center">
                        <div class="text-sm text-gray-500">Aceptadas</div>
                        <div class="text-lg font-semibold">{{ $acceptedCount ?? 0 }}</div>
                    </div>
                    <div class="px-3 py-2 bg-white rounded-lg shadow-sm text-center">
                        <div class="text-sm text-gray-500">Rechazadas</div>
                        <div class="text-lg font-semibold">{{ $rejectedCount ?? 0 }}</div>
                    </div>

                    <form method="GET" class="ml-2 flex items-center gap-2 bg-white rounded-lg shadow-sm px-3 py-2">
                        <input type="search" name="q" placeholder="Buscar candidato u oferta" value="{{ request('q') }}" class="text-sm rounded border-gray-200 px-3 py-2">
                        <select name="status" class="text-sm rounded border-gray-200 px-2 py-2">
                            <option value="">Todos</option>
                            <option value="pending" @if(request('status')=='pending') selected @endif>Pendiente</option>
                            <option value="accepted" @if(request('status')=='accepted') selected @endif>Aceptada</option>
                            <option value="rejected" @if(request('status')=='rejected') selected @endif>Rechazada</option>
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Buscar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="p-6 bg-gray-50">
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

                <div class="mt-6">{{ $applications->withQueryString()->links() }}</div>
            @else
                <div class="bg-white rounded-lg p-6 text-center text-gray-500">No hay postulaciones para mostrar.</div>
            @endif
        </div>
    </div>
</div>
@endsection
