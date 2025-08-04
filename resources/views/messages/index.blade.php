@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header mejorado -->
    <div class="mb-8 animate-fade-in-up">
        <div class="bg-white rounded-2xl shadow-soft p-8 mb-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-comments text-blue-800 mr-3"></i>
                    Centro de Mensajes
                </h1>
                <p class="text-gray-600">Mantente conectado con otros usuarios de la plataforma</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-xl mb-6 shadow-soft animate-slide-in">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulario para enviar mensaje -->
        <div class="lg:col-span-1">
            <div class="card-enhanced p-6 animate-fade-in-up">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-paper-plane text-blue-700 mr-2"></i>
                    Nuevo Mensaje
                </h2>

                <form action="{{ route('send-message') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Destinatario -->
                    <div>
                        <label for="receiver_id" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-1"></i>
                            Destinatario
                        </label>
                        <select name="receiver_id" id="receiver_id" required
                                class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 transition-all duration-300">
                            <option value="" disabled selected>Selecciona un usuario</option>
                            @foreach($users as $user)
                                @if($user->id !== auth()->id())
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('receiver_id')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Mensaje -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-edit mr-1"></i>
                            Mensaje
                        </label>
                        <textarea name="content" id="content" rows="6" required 
                                  class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-3 resize-none transition-all duration-300" 
                                  placeholder="Escribe tu mensaje aquí...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full btn-primary text-white py-3 rounded-xl hover-lift transition-all duration-300 font-medium shadow-soft">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </div>

        <!-- Mensajes -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Mensajes recibidos -->
            <div class="card-enhanced animate-fade-in-up">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-inbox text-blue-700 mr-2"></i>
                        Mensajes Recibidos
                        @if(count($received) > 0)
                            <span class="ml-2 bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                {{ count($received) }}
                            </span>
                        @endif
                    </h2>
                </div>

                <div class="p-6">
                    @forelse($received as $message)
                        <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-4 mb-4 border-l-4 border-blue-500 hover-lift transition-all duration-300">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 gradient-primary rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $message->sender->name }}</p>
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $message->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">
                                    Recibido
                                </span>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="text-gray-700 leading-relaxed">{{ $message->content }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-inbox text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No tienes mensajes</h3>
                            <p class="text-gray-500">Cuando alguien te envíe un mensaje, aparecerá aquí.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Mensajes enviados -->
            <div class="card-enhanced animate-fade-in-up">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-paper-plane text-green-700 mr-2"></i>
                        Mensajes Enviados
                        @if(count($sent) > 0)
                            <span class="ml-2 bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                {{ count($sent) }}
                            </span>
                        @endif
                    </h2>
                </div>

                <div class="p-6">
                    @forelse($sent as $message)
                        <div class="bg-gradient-to-r from-green-50 to-gray-50 rounded-xl p-4 mb-4 border-l-4 border-green-500 hover-lift transition-all duration-300">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-green-700 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Para: {{ $message->receiver->name }}</p>
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $message->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full font-medium">
                                    Enviado
                                </span>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="text-gray-700 leading-relaxed">{{ $message->content }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-paper-plane text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No has enviado mensajes</h3>
                            <p class="text-gray-500">Usa el formulario de la izquierda para enviar tu primer mensaje.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
