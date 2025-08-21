@extends('layouts.home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="bg-white rounded-2xl shadow-soft p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-comments text-blue-700 text-2xl mr-3"></i>
                    <div>
                        <h1 class="text-2xl font-bold">Centro de Mensajes</h1>
                        <p class="text-sm text-gray-500">Conversaciones y mensajes en tiempo real (UI simulada)</p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('message-form') }}" class="text-sm text-blue-600 hover:underline">Nuevo mensaje</a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-3 rounded-xl mb-6 shadow-soft">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-soft overflow-hidden" style="height:70vh;">
        <div class="flex h-full">
            <!-- Sidebar contactos -->
            <div class="w-80 border-r border-gray-100 p-4 flex flex-col">
                <div class="mb-4">
                    <input type="text" id="searchContacts" placeholder="Buscar..." class="w-full border border-gray-200 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200">
                </div>

                <div class="flex-1 overflow-auto" id="contactsList">
                    @php
                        $authId = auth()->id();
                        $contacts = [];
                        $messagesByContact = [];

                        foreach($received as $m) {
                            $id = $m->sender->id;
                            $contacts[$id] = $m->sender;
                            $messagesByContact[$id][] = $m;
                        }
                        foreach($sent as $m) {
                            $id = $m->receiver->id;
                            $contacts[$id] = $m->receiver;
                            $messagesByContact[$id][] = $m;
                        }

                        // Ordenar contactos por último mensaje
                        $contactOrder = array_keys($contacts);
                        usort($contactOrder, function($a,$b) use ($messagesByContact) {
                            $la = end($messagesByContact[$a])->created_at ?? null; reset($messagesByContact[$a]);
                            $lb = end($messagesByContact[$b])->created_at ?? null; reset($messagesByContact[$b]);
                            if (!$la && !$lb) return 0;
                            if (!$la) return 1;
                            if (!$lb) return -1;
                            return strtotime($lb) <=> strtotime($la);
                        });
                    @endphp

                    @forelse($contactOrder as $cid)
                        @php $contact = $contacts[$cid]; $last = end($messagesByContact[$cid]); reset($messagesByContact[$cid]); @endphp
                        <button class="contact-item w-full text-left p-3 rounded-xl mb-2 flex items-center hover:bg-gray-50 transition" data-target="conversation-{{ $contact->id }}">
                            <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold mr-3">{{ strtoupper(substr($contact->name,0,1)) }}</div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-semibold">{{ $contact->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $last->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="text-xs text-gray-500 truncate">{{ Str::limit($last->content, 60) }}</div>
                            </div>
                        </button>
                    @empty
                        <div class="text-center text-gray-500 mt-6">No hay conversaciones todavía</div>
                    @endforelse
                </div>
            </div>

            <!-- Panel de chat -->
            <div class="flex-1 p-6 flex flex-col">
                <div id="conversationsContainer" class="flex-1 overflow-auto">
                    @if(empty($contactOrder))
                        <div class="h-full flex items-center justify-center text-center text-gray-500">
                            <div>
                                <p class="text-lg font-semibold">Tu bandeja está vacía</p>
                                <p class="mt-2">Usa "Nuevo mensaje" para comenzar una conversación.</p>
                            </div>
                        </div>
                    @else
                        @foreach($contactOrder as $index => $cid)
                            @php $contact = $contacts[$cid]; $messages = $messagesByContact[$cid]; usort($messages, function($a,$b){ return strtotime($a->created_at) <=> strtotime($b->created_at); }); @endphp
                            <div id="conversation-{{ $contact->id }}" class="conversation-pane h-full flex flex-col" style="display: {{ $index===0 ? 'block' : 'none' }};">
                                <!-- Header conversación -->
                                <div class="flex items-center border-b border-gray-100 pb-4 mb-4">
                                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold mr-3">{{ strtoupper(substr($contact->name,0,1)) }}</div>
                                    <div>
                                        <div class="font-semibold">{{ $contact->name }}</div>
                                        <div class="text-xs text-gray-400">Conectado recientemente</div>
                                    </div>
                                </div>

                                <!-- Mensajes -->
                                <div class="flex-1 overflow-auto space-y-4" id="messages-{{ $contact->id }}">
                                    @foreach($messages as $msg)
                                        @php $isMe = $msg->sender_id === $authId; @endphp
                                        <div class="max-w-xl {{ $isMe ? 'ml-auto bg-blue-600 text-white' : 'mr-auto bg-gray-100 text-gray-800' }} rounded-xl p-3 shadow-sm">
                                            <div class="text-sm leading-relaxed">{!! nl2br(e($msg->content)) !!}</div>
                                            <div class="text-xs mt-2 text-gray-300 {{ $isMe ? 'text-gray-200' : 'text-gray-400' }}">{{ $msg->created_at->format('d/m/Y H:i') }}</div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Composer -->
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <form action="{{ route('send-message') }}" method="POST" class="flex items-start space-x-3">
                                        @csrf
                                        <input type="hidden" name="receiver_id" value="{{ $contact->id }}">
                                        <textarea name="content" rows="2" required placeholder="Escribe un mensaje..." class="flex-1 border border-gray-200 rounded-xl px-3 py-2 resize-none focus:ring-2 focus:ring-blue-200"></textarea>
                                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-xl">Enviar</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mejora UX: selección, scroll y envío con Enter
        document.addEventListener('DOMContentLoaded', function(){
            var contactItems = Array.from(document.querySelectorAll('.contact-item'));

            function openConversation(btn){
                var target = btn.dataset.target;
                document.querySelectorAll('.conversation-pane').forEach(function(p){ p.style.display = 'none'; });
                var el = document.getElementById(target);
                if(el) el.style.display = 'flex';
                // marcar seleccionado
                document.querySelectorAll('.contact-item').forEach(function(c){ c.classList.remove('bg-gray-100'); });
                btn.classList.add('bg-gray-100');
                // scroll al final
                var messages = el.querySelector('[id^="messages-"]');
                if(messages) messages.scrollTop = messages.scrollHeight;
                // focus al composer textarea
                var ta = el.querySelector('textarea[name="content"]');
                if(ta) ta.focus();
            }

            contactItems.forEach(function(btn){
                btn.addEventListener('click', function(){ openConversation(this); });
            });

            // Auto seleccionar primer contacto
            if(contactItems.length > 0){
                openConversation(contactItems[0]);
            }

            // Buscador simple de contactos
            var search = document.getElementById('searchContacts');
            if(search){
                search.addEventListener('input', function(){
                    var q = this.value.toLowerCase();
                    document.querySelectorAll('#contactsList .contact-item').forEach(function(item){
                        var nameEl = item.querySelector('.font-semibold');
                        var name = nameEl ? nameEl.textContent.toLowerCase() : '';
                        item.style.display = name.indexOf(q) === -1 ? 'none' : 'flex';
                    });
                });
            }

            // Enviar con Enter (Shift+Enter para nueva línea)
            document.querySelectorAll('.conversation-pane form textarea').forEach(function(ta){
                ta.addEventListener('keydown', function(e){
                    if(e.key === 'Enter' && !e.shiftKey){
                        e.preventDefault();
                        var form = this.closest('form');
                        if(form) form.submit();
                    }
                });
            });
        });
    </script>
</div>
@endsection
