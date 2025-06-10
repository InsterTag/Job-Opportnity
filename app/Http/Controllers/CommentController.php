<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Mostrar la lista de comentarios
    public function list()
    {
        $comments = Comment::with(['user', 'jobOffer'])->get();
        return view('home', compact('comments'));
    }

    // Mostrar el formulario para crear un comentario
    public function create()
    {
        return view('home');
    }

    // Guardar un nuevo comentario
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'job_offer_id' => 'required|exists:job_offers,id'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->job_offer_id = $request->job_offer_id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('home')
                        ->with('success', 'Comentario agregado exitosamente.');
    }

    // Mostrar el formulario para editar un comentario
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Verificar que el usuario sea el dueño del comentario
        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para editar este comentario.');
        }
        
        return view('comments.edit', compact('comment'));
    }

    // Actualizar un comentario existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment = Comment::findOrFail($id);
        
        // Verificar que el usuario sea el dueño del comentario
        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para editar este comentario.');
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('home')
                        ->with('success', 'Comentario actualizado exitosamente.');
    }

    // Eliminar un comentario
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Verificar que el usuario sea el dueño del comentario
        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para eliminar este comentario.');
        }

        $comment->delete();

        return redirect()->route('home')
                        ->with('success', 'Comentario eliminado exitosamente.');
    }
}
