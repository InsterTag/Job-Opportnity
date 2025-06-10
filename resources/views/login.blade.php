@extends('layouts.new-user')

@section('content')

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-400 text-red-700 rounded-md shadow-md max-w-md mx-auto flex items-start space-x-3">
            <svg class="w-6 h-6 flex-shrink-0 mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728"/>
            </svg>
            <div>
                <p class="font-semibold mb-1">¡Oops! Algo salió mal.</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('inicia-sesion') }}" method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        @csrf

        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Iniciar Sesión</h1>

        <!-- Email -->
        <label for="emailInput" class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
        <div class="relative mb-6">
            <input
                type="email"
                id="emailInput"
                name="email"
                value="{{ old('email') }}"
                placeholder="ejemplo@correo.com"
                required
                autofocus
                class="w-full border border-gray-300 rounded-lg py-3 pl-10 pr-4 text-gray-800 placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >
            <svg class="w-5 h-5 absolute top-3 left-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 12h.01M12 12h.01M8 12h.01M21 12c0-4.418-3.582-8-8-8s-8 3.582-8 8c0 1.4.42 2.703 1.14 3.796M21 12v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6" />
            </svg>
        </div>

        <!-- Password with eye toggle -->
        <label for="passwordInput" class="block text-gray-700 font-medium mb-2">Contraseña</label>
        <div class="relative mb-8">
            <input
                type="password"
                id="passwordInput"
                name="password"
                placeholder="********"
                required
                class="w-full border border-gray-300 rounded-lg py-3 pl-10 pr-12 text-gray-800 placeholder-gray-400
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >
            <svg class="w-5 h-5 absolute top-3 left-3 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 11c0-1.105-.895-2-2-2s-2 .895-2 2 .895 2 2 2 2-.895 2-2zm0 0v1a1 1 0 001 1h4a1 1 0 001-1v-1M16 16h.01" />
            </svg>
            <button type="button" id="togglePassword" class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </button>
        </div>

        <!-- Botón -->
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md
                   focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
        >
            CONTINUAR
        </button>

        <!-- Link registro -->
        <p class="mt-6 text-center text-gray-600">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Regístrate</a>
        </p>
    </form>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if(type === 'text'){
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.944-9.543-7a9.966 9.966 0 012.784-4.412m1.233-1.23A9.96 9.96 0 0112 5c4.478 0 8.269 2.944 9.543 7a10.07 10.07 0 01-4.132 5.128M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                `;
            } else {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        });
    </script>
@endsection
