@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">

        {{-- Navegación (breadcrumbs) --}}
        <nav class="mb-8">
            <ol class="flex text-gray-500 text-sm">
                <li><a href="{{ route('job-offers.index') }}" class="hover:text-blue-600">Ofertas de Trabajo</a></li>
                <li class="mx-2">/</li>
                <li>{{ $jobOffer->title }}</li>
            </ol>
        </nav>

        {{-- Mensaje de éxito al aplicar o actualizar --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        {{-- Cabecera de la oferta de trabajo --}}
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="flex justify-between items-start">
                <div>
                    {{-- Título y empresa --}}
                    <h1 class="editable text-3xl font-bold text-gray-900 mb-2" data-field="title">{{ $jobOffer->title }}</h1>
                    <div class="flex items-center text-gray-500">
                        <a href="{{ route('companies.show', $jobOffer->company) }}" class="hover:text-blue-600">
                            {{ $jobOffer->company->company_name }}
                        </a>
                        <span class="mx-2">•</span>
                        <span>Publicado {{ $jobOffer->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Botón de edición solo visible para usuarios autorizados --}}
                <div class="flex space-x-4">
                    @can('update', $jobOffer)
                    <a href="{{ route('job-offers.edit', $jobOffer) }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        {{-- Icono de lápiz --}}
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    @endcan
                </div>
            </div>

            {{-- Información rápida: ubicación, tipo de trabajo, contrato, experiencia --}}
            <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-6">
                {{-- Cada elemento representa un dato clave --}}
                <div>
                    <dt class="text-sm font-medium text-gray-500">Ubicación</dt>
                    <dd class="editable mt-1 text-sm text-gray-900" data-field="location">{{ $jobOffer->location }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tipo de trabajo</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($jobOffer->work_type) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Contrato</dt>
                    <dd class="editable mt-1 text-sm text-gray-900" data-field="contract_type">{{ ucfirst(str_replace('_', ' ', $jobOffer->contract_type)) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Experiencia</dt>
                    <dd class="editable mt-1 text-sm text-gray-900" data-field="experience_level">{{ ucfirst($jobOffer->experience_level) }}</dd>
                </div>
            </div>

            {{-- Categorías asociadas a la oferta --}}
            <div class="mt-6">
                <div class="flex flex-wrap gap-2">
                    @foreach($jobOffer->categories as $category)
                    <span class="badge bg-primary">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Estadísticas de la oferta (aplicaciones, vistas, fecha límite) --}}
            <div class="mt-6 border-t border-gray-200 pt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6 text-sm text-gray-500">
                        <span>{{ $jobOffer->applications->count() }} aplicaciones</span>
                        <span>{{ $jobOffer->views_count }} vistas</span>
                        @if($jobOffer->deadline)
                        <span>Fecha límite: {{ $jobOffer->deadline->format('d/m/Y') }}</span>
                        @endif
                    </div>
                    
                    {{-- Botón para aplicar (si autorizado) --}}
                    <div class="flex items-center space-x-4">
                        @can('apply', $jobOffer)
                        <button type="button" 
                                onclick="document.getElementById('application-modal').classList.remove('hidden')"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Aplicar ahora
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección principal y sidebar --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Columna principal --}}
            <div class="md:col-span-2 space-y-6">

                {{-- Descripción del puesto --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Descripción del puesto</h2>
                    <div class="prose max-w-none">
                        <p class="editable" data-field="description">{!! nl2br(e($jobOffer->description)) !!}</p>
                    </div>
                </div>

                {{-- Requisitos (si existen) --}}
                @if($jobOffer->requirements)
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Requisitos</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($jobOffer->requirements)) !!}
                    </div>
                </div>
                @endif

                {{-- Beneficios (si existen) --}}
                @if($jobOffer->benefits)
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Beneficios</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($jobOffer->benefits)) !!}
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">

                {{-- Información sobre la empresa --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Sobre la empresa</h2>
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $jobOffer->company->company_name }}</h3>
                            @if($jobOffer->company->description)
                            <p class="mt-1 text-sm text-gray-500">{{ $jobOffer->company->description }}</p>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('companies.show', $jobOffer->company) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                Ver perfil completo →
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Información salarial --}}
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Información salarial</h2>
                    <div class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Rango salarial</dt>
                            <dd class="editable mt-1 text-sm text-gray-900" data-field="salary">{{ $jobOffer->salary_range }}</dd>
                        </div>
                        @if($jobOffer->salary_currency)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Moneda</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $jobOffer->salary_currency }}</dd>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- Modal para aplicar a la oferta --}}
<div id="application-modal" class="fixed z-10 inset-0 overflow-y-auto hidden" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full">

            {{-- Formulario de aplicación --}}
            <form action="{{ route('job-offers.apply', $jobOffer) }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900">Aplicar a: {{ $jobOffer->title }}</h3>
                    <div class="mt-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Mensaje de presentación</label>
                        <textarea id="message" name="message" rows="4" class="block w-full border-gray-300 rounded-md" required></textarea>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 flex justify-end">
                    <button type="submit" class="btn btn-primary">Enviar aplicación</button>
                    <button type="button" class="btn btn-secondary ml-3" onclick="document.getElementById('application-modal').classList.add('hidden')">Cancelar</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Script para editar campos inline --}}
@can('update', $jobOffer)
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editables = document.querySelectorAll('.editable');

            editables.forEach(element => {
                element.addEventListener('click', function() {
                    if (this.isEditing) return;

                    const field = this.dataset.field;
                    const currentValue = this.innerText;

                    let input;
                    if (field === 'description') {
                        input = document.createElement('textarea');
                        input.rows = 4;
                    } else if (field === 'contract_type' || field === 'experience_level') {
                        input = document.createElement('select');
                        const options = field === 'contract_type' 
                            ? ['tiempo_completo', 'medio_tiempo', 'proyecto', 'practicas'] 
                            : ['junior', 'medio', 'senior', 'lead'];
                        options.forEach(opt => {
                            const option = document.createElement('option');
                            option.value = opt;
                            option.text = opt.replace('_', ' ');
                            option.selected = opt === currentValue;
                            input.appendChild(option);
                        });
                    } else {
                        input = document.createElement('input');
                        input.type = field === 'salary' ? 'number' : 'text';
                        input.step = field === 'salary' ? '0.01' : null;
                    }

                    input.value = currentValue;
                    this.innerHTML = '';
                    this.appendChild(input);
                    this.isEditing = true;
                    input.focus();

                    const saveChanges = () => {
                        const newValue = input.value;
                        fetch(`/ofertas/${{{ $jobOffer->id }}}/inline`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ field: field, value: newValue })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.innerHTML = data.value;
                            } else {
                                alert(data.error);
                                this.innerHTML = currentValue;
                            }
                            this.isEditing = false;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al actualizar el campo');
                            this.innerHTML = currentValue;
                            this.isEditing = false;
                        });
                    };

                    input.addEventListener('blur', saveChanges);
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter' && field !== 'description') {
                            e.preventDefault();
                            saveChanges();
                        }
                    });
                });
            });
        });
    </script>
    @endpush
@endcan
@endsection
