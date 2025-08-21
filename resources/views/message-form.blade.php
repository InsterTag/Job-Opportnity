@extends('layouts.home')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
        <div class="flex h-[72vh]">
            <!-- Contactos -->
            <aside class="w-80 border-r border-gray-100 p-4 flex flex-col">
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Contactos</h3>
                    <a href="{{ route('messages') }}" class="text-sm text-indigo-600 hover:underline">Volver</a>
                </div>

                <div class="mb-3">
                    <input id="contactSearch" placeholder="Buscar contacto..." class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" aria-label="Buscar contactos">
                </div>

                <div class="flex-1 overflow-auto divide-y divide-gray-100" id="contactList">
                    @foreach($users as $user)
                        @if($user->id !== auth()->id())
                            <button type="button" class="w-full text-left p-3 hover:bg-gray-50 contact-row flex items-center gap-3 focus:outline-none focus:ring-2 focus:ring-indigo-100" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-full flex items-center justify-center font-semibold text-sm">{{ strtoupper(substr($user->name,0,1)) }}</div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <div class="font-medium text-sm truncate">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-400">&nbsp;</div>
                                    </div>
                                    <div class="text-xs text-gray-500 truncate">Perfil</div>
                                </div>
                            </button>
                        @endif
                    @endforeach
                </div>
            </aside>

            <!-- Composer -->
            <main class="flex-1 p-6 flex flex-col">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div id="selectedAvatar" class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center font-semibold text-sm text-gray-600">?</div>
                        <div>
                            <h2 id="selectedName" class="text-lg font-bold">Nuevo mensaje</h2>
                            <p id="selectedSubtitle" class="text-sm text-gray-500">Selecciona un contacto para ver detalles</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 flex items-center gap-3">
                        <span class="inline-flex items-center bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs">
                            <kbd class="font-medium">Enter</kbd>
                            <span class="ml-2">Enviar</span>
                        </span>
                        <span class="inline-flex items-center bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs">
                            <kbd class="font-medium">Shift</kbd>
                            <span class="mx-1">+</span>
                            <kbd class="font-medium">Enter</kbd>
                            <span class="ml-2">Nueva línea</span>
                        </span>
                    </div>
                </div>

                <div class="flex-1 bg-white rounded-lg p-6 flex flex-col shadow-sm">
                    <form id="messageForm" action="{{ route('send-message') }}" method="POST" class="flex flex-col h-full">
                        @csrf
                        <input type="hidden" name="receiver_id" id="receiver_id" value=""> 

                        <div class="mb-4">
                            <label class="block text-sm text-gray-600">Destinatario</label>
                            <div id="selectedRecipient" class="mt-2 text-sm text-gray-800">Ninguno seleccionado</div>
                            @error('receiver_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex-1">
                            <label for="content" class="block text-sm text-gray-600">Mensaje</label>
                            <textarea name="content" id="content" rows="6" class="mt-2 w-full border border-gray-200 rounded-lg p-3 resize-none focus:ring-2 focus:ring-indigo-200" placeholder="Escribe tu mensaje...">{{ old('content') }}</textarea>
                            @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <a href="{{ route('messages') }}" class="text-sm text-gray-600 mr-3">Cancelar</a>
                            <button type="submit" id="sendBtn" class="btn-primary bg-indigo-600 text-white px-4 py-2 rounded-lg disabled:opacity-60" disabled>Enviar</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        var contactRows = Array.from(document.querySelectorAll('.contact-row'));
        var receiverInput = document.getElementById('receiver_id');
        var selectedRecipient = document.getElementById('selectedRecipient');
        var search = document.getElementById('contactSearch');

        function selectContact(id, name, el){
            receiverInput.value = id;
            selectedRecipient.textContent = name;
            // header
            var avatar = document.getElementById('selectedAvatar');
            var sname = document.getElementById('selectedName');
            var ssub = document.getElementById('selectedSubtitle');
            if(avatar) avatar.textContent = name.charAt(0).toUpperCase();
            if(sname) sname.textContent = name;
            if(ssub) ssub.textContent = 'Envíale un mensaje';
            // marcar visualmente
            document.querySelectorAll('.contact-row').forEach(function(r){ r.classList.remove('bg-gray-100'); });
            if(el) el.classList.add('bg-gray-100');
            // habilitar botón
            var sendBtn = document.getElementById('sendBtn');
            if(sendBtn) sendBtn.disabled = false;
            document.getElementById('content').focus();
        }

        contactRows.forEach(function(row){
            row.addEventListener('click', function(){
                selectContact(this.dataset.id, this.dataset.name, this);
            });
        });

        if(contactRows.length > 0){
            // seleccionar el primero por defecto
            var first = contactRows[0];
            selectContact(first.dataset.id, first.dataset.name, first);
        }

        search.addEventListener('input', function(){
            var q = this.value.toLowerCase();
            contactRows.forEach(function(row){
                var name = row.dataset.name.toLowerCase();
                row.style.display = name.indexOf(q) === -1 ? 'none' : 'flex';
            });
        });

        // Enviar con Enter (Shift+Enter nueva línea)
        var textarea = document.getElementById('content');
        textarea.addEventListener('keydown', function(e){
            if(e.key === 'Enter' && !e.shiftKey){
                e.preventDefault();
                // validar que haya destinatario
                if(!receiverInput.value){
                    alert('Selecciona un destinatario primero');
                    return;
                }
                document.getElementById('messageForm').submit();
            }
        });
    });
</script>

@endsection
