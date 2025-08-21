@props(['application'])

<div class="bg-white rounded-lg shadow-lg p-6 transition-shadow hover:shadow-xl">
    @php $latestInterview = $application->interviews()->orderByDesc('scheduled_at')->first(); @endphp

    @if(auth()->user()?->isUnemployed() && auth()->user()->unemployed->id === $application->unemployed_id)
        <!-- Diseño destacado para cesante -->
        <div class="md:flex md:items-center gap-6">
            <div class="flex-shrink-0">
                <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($application->unemployed->user->name, 0, 2)) }}
                </div>
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <a href="{{ route('job-offers.show', $application->jobOffer->id) }}" class="text-lg md:text-xl font-extrabold text-gray-800 hover:text-blue-700 truncate">{{ $application->jobOffer->title }}</a>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm text-gray-600">{{ $application->jobOffer->company->name }}</span>
                            @php
                                $badgeClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'accepted' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    'scheduled' => 'bg-blue-100 text-blue-800',
                                ];
                                $badgeClass = $badgeClasses[$application->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="ml-2 inline-block px-2 py-0.5 rounded {{ $badgeClass }} text-xs font-semibold">{{ $application->status_label }}</span>
                        </div>
                    </div>

                    <div class="text-right hidden md:block">
                        <div class="text-sm text-gray-500">{{ $application->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <p class="mt-3 text-gray-700 text-sm md:text-base">{{ Str::limit($application->message ?? 'Sin mensaje', 220) }}</p>

                @if($latestInterview)
                    <div class="mt-4 p-4 bg-gradient-to-r from-green-50 to-white border border-green-100 rounded-lg flex items-center justify-between">
                        <div>
                            <div class="text-sm font-semibold text-green-700">Entrevista programada</div>
                            <div class="text-xs text-gray-500">{{ $latestInterview->scheduled_at->format('d/m/Y H:i') }} · {{ $latestInterview->mode ?? 'N/A' }}</div>
                        </div>
                        <div class="text-right text-sm text-gray-600">Duración: {{ $latestInterview->duration_minutes ?? 30 }} min</div>
                    </div>
                @endif

                <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        @if($application->cv_url)
                            <a href="{{ route('job-applications.download-cv', $application->id) }}" class="inline-flex items-center gap-2 border border-gray-200 rounded px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">📄 Descargar CV</a>
                        @endif
                        @if(false)
                            {{-- Mensaje oculto en la vista de cesante según petición del usuario --}}
                            {{-- <button type="button" class="inline-flex items-center gap-2 border border-gray-200 rounded px-3 py-2 text-sm text-gray-700 hover:bg-gray-50" onclick="openMessageModalFromTemplate({{ $application->id }})">💬 Ver mensaje</button>
                            <template id="messageTemplate-{{ $application->id }}" hidden>{{ $application->message }}</template> --}}
                        @endif
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('interviews.index', $application->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm">Ver horarios</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Versión para empresa / vista compacta (sin cambios funcionales) -->
        <div class="flex items-start gap-4">
            <div class="w-16 h-16 rounded-full gradient-primary flex items-center justify-center text-white text-lg font-bold flex-shrink-0">
                {{ strtoupper(substr($application->unemployed->user->name, 0, 2)) }}
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                            <div class="flex items-center gap-3 flex-wrap">
                            <a href="{{ route('job-offers.show', $application->jobOffer->id) }}" class="font-semibold text-gray-800 hover:text-blue-700 truncate">{{ $application->jobOffer->title }}</a>
                            <span class="text-gray-400">·</span>
                            <span class="text-gray-600 truncate">{{ $application->jobOffer->company->name }}</span>
                            @php
                                $badgeClass = $badgeClasses[$application->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="ml-2 inline-block px-2 py-1 rounded {{ $badgeClass }} text-xs font-semibold">{{ $application->status_label }}</span>
                        </div>

                        <div class="mt-2 text-sm text-gray-700 truncate">{{ Str::limit($application->message ?? 'Sin mensaje', 160) }}</div>
                        @if($latestInterview)
                            <div class="mt-3 p-3 bg-gray-50 rounded text-sm text-gray-700">
                                <div class="font-semibold text-gray-800">Entrevista programada</div>
                                <div class="text-xs text-gray-500">{{ $latestInterview->scheduled_at->format('d/m/Y H:i') }} · {{ $latestInterview->mode ?? 'N/A' }} · {{ $latestInterview->location ?? 'Sin ubicación' }}</div>
                            </div>
                        @endif
                        <div class="mt-2 text-xs text-gray-400">{{ $application->unemployed->user->name }} · {{ $application->created_at->diffForHumans() }}</div>
                        <div class="mt-3">
                            @if($application->cv_url)
                                <a href="{{ route('job-applications.download-cv', $application->id) }}" class="text-blue-600 underline text-sm mr-3">Descargar CV</a>
                            @endif
                            @if($application->message && Str::length($application->message) > 140)
                                <button type="button" class="text-sm text-blue-600 underline" onclick="openMessageModalFromTemplate({{ $application->id }})">Ver mensaje</button>
                                <template id="messageTemplate-{{ $application->id }}" hidden>{{ $application->message }}</template>
                            @endif
                        </div>
                    </div>

                    <div class="flex-shrink-0 text-right">
                        @if(auth()->user()?->isCompany() && auth()->user()->company->id === $application->jobOffer->company_id)
                            <div class="text-sm text-gray-600 mb-2">{{ isset($latestInterview) ? 'Ya has programado entrevista' : $application->status_label }}</div>
                        @else
                            <div class="text-sm text-gray-600 mb-2">{{ $application->status_label }}</div>
                        @endif
                        <div class="flex flex-col items-end gap-2">
                            @if(auth()->user()?->isCompany() && auth()->user()->company->id === $application->jobOffer->company_id)
                                <form action="{{ route('job-applications.update-status', $application->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="border rounded px-3 py-1 text-sm">
                                        <option value="pending" @if($application->status=='pending') selected @endif>Pendiente</option>
                                        <option value="accepted" @if($application->status=='accepted') selected @endif>Aceptada</option>
                                        <option value="rejected" @if($application->status=='rejected') selected @endif>Rechazada</option>
                                    </select>
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Actualizar</button>
                                </form>

                                @if($application->status === 'accepted')
                                    <button type="button" class="bg-green-600 text-white px-3 py-1 rounded text-sm" onclick="openScheduleModal({{ $application->id }})">Programar Entrevista</button>
                                @endif
                            @endif

                            @if(auth()->user()?->isUnemployed() && auth()->user()->unemployed->id === $application->unemployed_id)
                                <a href="{{ route('interviews.index', $application->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded text-sm">Ver horarios</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Message Modal -->
    <div id="messageModal-{{ $application->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden" style="background-color: rgba(0,0,0,0.06); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
        <div class="bg-white rounded-lg shadow p-6 max-w-lg w-full relative border">
            <button onclick="closeMessageModal({{ $application->id }})" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
            <h3 class="text-lg font-semibold mb-3">Mensaje de postulación</h3>
            <div id="messageModalContent-{{ $application->id }}" class="text-gray-700 whitespace-pre-line"></div>
        </div>
    </div>

    <!-- Schedule Modal (company only) -->
    @if(auth()->user()?->isCompany() && auth()->user()->company->id === $application->jobOffer->company_id)
    <div id="scheduleModal-{{ $application->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden" style="background-color: rgba(0,0,0,0.08); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full relative">
            <button onclick="closeScheduleModal({{ $application->id }})" class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl">&times;</button>
            <h3 class="text-lg font-bold mb-2">Programar entrevista para {{ $application->unemployed->user->name }}</h3>
            <form action="{{ route('interviews.store', $application->id) }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha y hora</label>
                    <input type="datetime-local" name="scheduled_at" class="border rounded w-full px-2 py-1" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Duración (min)</label>
                    <input type="number" name="duration_minutes" class="border rounded w-full px-2 py-1" value="30" min="10" required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Modalidad</label>
                    <select name="mode" class="border rounded w-full px-2 py-1">
                        <option value="online">Online</option>
                        <option value="in-person">Presencial</option>
                    </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ubicación / enlace</label>
                        <input type="text" name="location" class="border rounded w-full px-2 py-1" placeholder="URL o dirección (opcional)" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeScheduleModal({{ $application->id }})" class="mr-2 border rounded px-3 py-1">Cancelar</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @push('scripts')
        <script>
        function openMessageModal(id, message){
            const content = document.getElementById('messageModalContent-'+id);
            const modal = document.getElementById('messageModal-'+id);
            if(content) content.textContent = message;
            if(modal) modal.classList.remove('hidden');
        }
        function closeMessageModal(id){
            const modal = document.getElementById('messageModal-'+id);
            if(modal) modal.classList.add('hidden');
        }

        function openMessageModalFromTemplate(id){
            const tpl = document.getElementById('messageTemplate-'+id);
            const content = tpl ? tpl.innerHTML : '';
            openMessageModal(id, content);
        }

        function openScheduleModal(id){
            const modal = document.getElementById('scheduleModal-'+id);
            if(modal) modal.classList.remove('hidden');
        }
        function closeScheduleModal(id){
            const modal = document.getElementById('scheduleModal-'+id);
            if(modal) modal.classList.add('hidden');
        }
        </script>
        @endpush

    </div>
