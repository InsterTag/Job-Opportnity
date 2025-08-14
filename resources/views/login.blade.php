@extends('layouts.new-user')

@section('content')

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="mb-6 p-6 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-700 rounded-xl shadow-soft max-w-md mx-auto animate-fade-in-up">
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                    <p class="font-semibold mb-2 text-red-800">¡Oops! Algo salió mal.</p>
                    <ul class="space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center">
                                <i class="fas fa-dot-circle mr-2 text-xs text-red-500"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-md mx-auto animate-fade-in-up">
        <div class="card-enhanced p-8 hover-lift">
            <!-- Header del formulario -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 gradient-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lock text-2xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Iniciar Sesión</h1>
                <p class="text-gray-600">Accede a tu cuenta para continuar</p>
            </div>

            <form action="{{ route('inicia-sesion') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-6">
                    <label for="emailInput" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <i class="fas fa-envelope mr-2 text-blue-500"></i>
                        Correo Electrónico
                    </label>
                    <div class="relative">
                        <input
                            type="email"
                            id="emailInput"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="ejemplo@correo.com"
                            required
                            autofocus
                            class="w-full border-2 border-gray-200 rounded-xl py-4 pl-12 pr-4 text-gray-800 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 hover:border-blue-300"
                        >
                        <div class="absolute top-4 left-4 text-gray-400">
                            <i class="fas fa-at"></i>
                        </div>
                    </div>
                </div>

                <!-- Password with eye toggle -->
                <div class="mb-8">
                    <label for="passwordInput" class="block text-gray-700 font-medium mb-2 flex items-center">
                        <i class="fas fa-key mr-2 text-blue-500"></i>
                        Contraseña
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="passwordInput"
                            name="password"
                            placeholder="********"
                            required
                            class="w-full border-2 border-gray-200 rounded-xl py-4 pl-12 pr-12 text-gray-800 placeholder-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 hover:border-blue-300"
                        >
                        <div class="absolute top-4 left-4 text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                        <button type="button" id="togglePassword" class="absolute right-4 top-4 text-gray-400 hover:text-blue-600 focus:outline-none transition-colors">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Botón mejorado -->
                <button
                    type="submit"
                    class="w-full btn-primary text-white font-semibold py-4 rounded-xl shadow-soft
                           focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300 hover-lift mb-6"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    INICIAR SESIÓN
                </button>

                <!-- Links adicionales -->
                <div class="text-center space-y-3">
                    <a href="#" class="block text-blue-600 hover:text-blue-700 text-sm transition-colors">
                        <i class="fas fa-key mr-1"></i>
                        ¿Olvidaste tu contraseña?
                    </a>
                    
                    <div class="divider-gradient my-4"></div>
                    
                    <p class="text-gray-600">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium transition-colors">
                            <i class="fas fa-user-plus mr-1"></i>
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'password') {
                eyeIcon.className = 'fas fa-eye';
            } else {
                eyeIcon.className = 'fas fa-eye-slash';
            }
        });
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
