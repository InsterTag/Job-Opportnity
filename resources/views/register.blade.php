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
        <label class="block text-gray-700 font-semibold mb-4">Tipo de Usuario</label>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Tarjeta Cesante --}}
            <div class="user-type-card relative cursor-pointer" data-value="unemployed">
                <input 
                    type="radio" 
                    name="type" 
                    value="unemployed" 
                    id="unemployed" 
                    class="hidden" 
                    {{ old('type') == 'unemployed' ? 'checked' : '' }}
                    required
                >
                <label for="unemployed" class="block w-full cursor-pointer">
                    <div class="border-2 border-gray-300 rounded-xl p-6 h-60 transition-all duration-300 hover:border-blue-400 hover:shadow-md flex items-center">
                        <div class="text-center w-full">
                            <div class="w-12 h-12 mx-auto mb-3 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Cesante</h3>
                            <p class="text-sm text-gray-600 leading-snug">Busco oportunidades laborales y capacitaciones profesionales</p>
                        </div>
                    </div>
                </label>
            </div>

            {{-- Tarjeta Empresa --}}
            <div class="user-type-card relative cursor-pointer" data-value="company">
                <input 
                    type="radio" 
                    name="type" 
                    value="company" 
                    id="company" 
                    class="hidden" 
                    {{ old('type') == 'company' ? 'checked' : '' }}
                    required
                >
                <label for="company" class="block w-full cursor-pointer">
                    <div class="border-2 border-gray-300 rounded-xl p-6 h-60 transition-all duration-300 hover:border-blue-400 hover:shadow-md flex items-center">
                        <div class="text-center w-full">
                            <div class="w-12 h-12 mx-auto mb-3 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Empresa</h3>
                            <p class="text-sm text-gray-600 leading-snug">Publico ofertas laborales, busco talento calificado y gestiono procesos de reclutamiento</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        @error('type')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
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

    // Manejo de selección de tarjetas de tipo de usuario
    const userTypeCards = document.querySelectorAll('.user-type-card');
    const typeInputs = document.querySelectorAll('input[name="type"]');

    // Función para actualizar estilos de las tarjetas
    function updateCardStyles() {
        userTypeCards.forEach(card => {
            const input = card.querySelector('input[type="radio"]');
            const cardDiv = card.querySelector('div[class*="border-2"]');
            
            if (input.checked) {
                cardDiv.classList.remove('border-gray-300', 'bg-white');
                cardDiv.classList.add('border-blue-600', 'bg-blue-100', 'shadow-xl');
                cardDiv.classList.add('ring-4', 'ring-blue-300');
            } else {
                cardDiv.classList.remove('border-blue-600', 'bg-blue-100', 'shadow-xl');
                cardDiv.classList.remove('ring-4', 'ring-blue-300');
                cardDiv.classList.add('border-gray-300', 'bg-white');
            }
        });
    }

    // Agregar event listeners a las tarjetas
    userTypeCards.forEach(card => {
        card.addEventListener('click', function() {
            const input = this.querySelector('input[type="radio"]');
            input.checked = true;
            updateCardStyles();
        });
    });

    // Agregar event listeners a los inputs radio
    typeInputs.forEach(input => {
        input.addEventListener('change', updateCardStyles);
    });

    // Inicializar estilos al cargar la página
    updateCardStyles();
</script>
@endsection
    