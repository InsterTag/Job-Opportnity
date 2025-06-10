@extends('layouts.new-user')

@section('content')
<form action="{{ route('create-user') }}" method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg mt-12 mb-12">
    @csrf

    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Registro de Usuario</h1>

    {{-- Nombre Completo --}}
    <div class="mb-6">
        <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre Completo</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            placeholder="Tu nombre completo"
            required
            autofocus
            autocomplete="name"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800 placeholder-gray-400
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        >
        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Correo Electrónico --}}
    <div class="mb-6">
        <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="ejemplo@correo.com"
            required
            autocomplete="email"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800 placeholder-gray-400
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        >
        @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Contraseña con "ojito" --}}
    <div class="mb-8 relative">
        <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
        <input
            type="password"
            id="password"
            name="password"
            placeholder="Mínimo 8 caracteres"
            required
            autocomplete="new-password"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 pr-12 text-gray-800 placeholder-gray-400
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        >
        <button type="button" id="togglePassword" class="absolute right-3 top-9 text-gray-500 hover:text-gray-700 focus:outline-none" aria-label="Mostrar u ocultar contraseña">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>
        <p class="text-sm text-gray-500 mt-1">Mínimo 8 caracteres</p>
        @error('password')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tipo de Usuario --}}
    <div class="mb-8">
        <label for="type" class="block text-gray-700 font-semibold mb-2">Tipo de Usuario</label>
        <select
            name="type"
            id="type"
            required
            class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
        >
            <option value="" disabled selected>Seleccione una opción</option>
            <option value="unemployed" {{ old('type') == 'unemployed' ? 'selected' : '' }}>Cesante</option>
            <option value="company" {{ old('type') == 'company' ? 'selected' : '' }}>Empresa</option>
        </select>
        @error('type')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Botón Registrar --}}
    <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-md
               focus:outline-none focus:ring-4 focus:ring-blue-300 transition">
        Registrarse
    </button>

    {{-- Link a Login --}}
    <p class="mt-6 text-center text-gray-600">
        ¿Ya tienes una cuenta?
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Inicia sesión</a>
    </p>
</form>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', () => {
        // Alternar tipo de input
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Cambiar icono
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
    