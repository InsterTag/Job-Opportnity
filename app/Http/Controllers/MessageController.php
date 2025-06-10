<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    // Mostrar el formulario para enviar un nuevo mensaje
    public function create()
    {
        // Puedes pasar la lista de usuarios aquí para el select destinatarios si quieres
        $users = User::select('id', 'name')->get();

        return view('message-form', compact('users'));
    }

    // Enviar un mensaje a otro usuario
    public function send_message(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'receiver_id' => 'required|integer|exists:users,id', // El destinatario debe existir
            'content' => 'required|string|max:500', // El mensaje no debe superar 500 caracteres
        ]);

        // Crear el mensaje
        $message = new Message();
        $message->sender_id = Auth::id(); // Usuario autenticado como emisor
        $message->receiver_id = $validated['receiver_id'];
        $message->content = $validated['content'];

        // Guardar el mensaje
        $message->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('messages')->with('success', 'Mensaje enviado con éxito');
    }

    // Mostrar los mensajes enviados y recibidos del usuario autenticado
    public function index()
    {
        $userId = Auth::id();

        // Obtener todos los usuarios para poder seleccionar destinatario en la vista
        $users = User::select('id', 'name')->get();

        // Mensajes recibidos con relación al emisor cargada
        $received = Message::with('sender')
                    ->where('receiver_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Mensajes enviados con relación al receptor cargada
        $sent = Message::with('receiver')
                    ->where('sender_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('messages.index', compact('users', 'received', 'sent'));
    }
}
