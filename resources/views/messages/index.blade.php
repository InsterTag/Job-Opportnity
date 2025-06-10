@extends('layouts.home')

@section('content')
<main class="container mx-auto py-8 px-6">

    <h1 class="text-3xl font-bold text-center mb-8">Tus Mensajes</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario para enviar mensaje -->
    <section class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto mb-8">
        <h2 class="text-2xl font-semibold text-center mb-4">Enviar Mensaje</h2>

        <form action="{{ route('send-message') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <label for="receiver_id" class="block text-gray-700 font-medium">Destinatario</label>
                <select name="receiver_id" id="receiver_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Selecciona un usuario</option>
                    @foreach($users as $user)
                        @if($user->id !== auth()->id())
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('receiver_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <label for="content" class="block text-gray-700 font-medium">Mensaje</label>
                <textarea name="content" id="content" rows="4" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none" placeholder="Escribe tu mensaje aquí...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-400">
                    Enviar
                </button>
            </div>
        </form>
    </section>

    <!-- Mensajes recibidos -->
    <section class="max-w-4xl mx-auto space-y-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-blue-600">Recibidos</h2>

            @forelse($received as $message)
                <div class="border-b py-3">
                    <p><strong>De:</strong> {{ $message->sender->name }}</p>
                    <p class="text-gray-700">{{ Str::limit($message->content, 150) }}</p>
                    <p class="text-sm text-gray-400">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                </div>
            @empty
                <p class="text-gray-500">No has recibido mensajes.</p>
            @endforelse
        </div>

        <!-- Mensajes enviados -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-green-600">Enviados</h2>

            @forelse($sent as $message)
                <div class="border-b py-3">
                    <p><strong>Para:</strong> {{ $message->receiver->name }}</p>
                    <p class="text-gray-700">{{ Str::limit($message->content, 150) }}</p>
                    <p class="text-sm text-gray-400">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                </div>
            @empty
                <p class="text-gray-500">No has enviado mensajes aún.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection
