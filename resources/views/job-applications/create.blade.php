@extends('layouts.home')
@section('content')
<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="text-sm text-gray-600 hover:text-gray-800 inline-flex items-center gap-2">← Volver</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-extrabold text-gray-800 mb-3">Postularse a una oferta</h2>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('job-applications.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="unemployed_id" value="{{ $unemployed_id ?? '' }}">
            <input type="hidden" name="job_offer_id" value="{{ $job_offer_id ?? '' }}">

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Mensaje (opcional)</label>
                <textarea name="message" id="message" rows="4" maxlength="2000" class="mt-1 block w-full border border-gray-200 rounded-md px-3 py-2">{{ old('message') }}</textarea>
            </div>

            <div>
                <label for="cv" class="block text-sm font-medium text-gray-700">Adjuntar CV (opcional, PDF/DOC/DOCX, máx 5MB)</label>
                <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" class="mt-1 block w-full border border-gray-200 rounded px-2 py-1">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-3 rounded-lg hover:bg-indigo-700 font-semibold">Enviar postulación</button>
            </div>
        </form>
    </div>
</div>
@endsection
