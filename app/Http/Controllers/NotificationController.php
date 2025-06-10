<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Mostrar lista de notificaciones
    public function list()
    {
        $notifications = Notification::where('user_id', Auth::id())
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        return view('home', compact('notifications'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('home');
    }

    // Guardar nueva notificación
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id'
        ]);

        $notification = new Notification();
        $notification->user_id = $request->user_id;
        $notification->message = $request->message;
        $notification->read = false;
        $notification->save();

        return redirect()->route('home')
                        ->with('success', 'Notificación enviada exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Verificar que el usuario sea el destinatario de la notificación
        if ($notification->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para editar esta notificación.');
        }
        
        return view('notifications.edit', compact('notification'));
    }

    // Actualizar notificación
    public function update(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $notification = Notification::findOrFail($id);
        
        // Verificar que el usuario sea el destinatario de la notificación
        if ($notification->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para editar esta notificación.');
        }

        $notification->message = $request->message;
        $notification->save();

        return redirect()->route('home')
                        ->with('success', 'Notificación actualizada exitosamente.');
    }

    // Marcar notificación como leída
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Verificar que el usuario sea el destinatario de la notificación
        if ($notification->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para marcar esta notificación.');
        }

        $notification->read = true;
        $notification->save();

        return redirect()->route('home')
                        ->with('success', 'Notificación marcada como leída.');
    }

    // Eliminar notificación
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Verificar que el usuario sea el destinatario de la notificación
        if ($notification->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para eliminar esta notificación.');
        }

        $notification->delete();

        return redirect()->route('home')
                        ->with('success', 'Notificación eliminada exitosamente.');
    }
}
