@extends('layouts.home')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-start justify-between gap-4 mb-4">
            <div>
                <a href="{{ \Illuminate\Support\Facades\Route::has('job-applications.index-unemployed') ? route('job-applications.index-unemployed') : url()->previous() }}" class="text-sm text-gray-600 hover:text-gray-800 inline-flex items-center gap-2">← Volver</a>
                <h2 class="text-2xl font-extrabold text-gray-800 mt-2">Entrevistas para: {{ $application->jobOffer->title }}</h2>
                <p class="text-sm text-gray-500 mt-1">Lista de entrevistas programadas para esta postulación.</p>
            </div>
            <div class="text-sm text-gray-600">Total: {{ $interviews->count() }}</div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @if($interviews->isEmpty())
            <div class="p-4 bg-gray-50 border border-gray-200 rounded">No hay entrevistas programadas.</div>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($interviews as $interview)
                    @php
                        $modeLabel = match($interview->mode) {
                            'in-person' => 'Presencial',
                            'online' => 'En línea',
                            default => ucfirst($interview->mode)
                        };
                        $badgeClasses = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'accepted' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                            'scheduled' => 'bg-blue-100 text-blue-800',
                        ];
                        $badgeClass = $badgeClasses[$interview->status] ?? 'bg-gray-100 text-gray-700';
                    @endphp

                    <div class="p-4 bg-white border rounded flex items-center justify-between">
                        <div>
                            <div class="font-semibold">{{ $interview->scheduled_at->format('d/m/Y H:i') }} ({{ $interview->duration_minutes }} min)</div>
                            <div class="text-sm text-gray-600">{{ $modeLabel }}@if($interview->location) · {{ $interview->location }}@endif</div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="px-2 py-1 rounded {{ $badgeClass }} text-xs font-semibold">{{ $interview->status_label }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
