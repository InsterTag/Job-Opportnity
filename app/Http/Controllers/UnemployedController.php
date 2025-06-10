<?php

namespace App\Http\Controllers;
use App\Models\Unemployed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnemployedController extends Controller
{
    
    // Mostrar formulario de creación
    public function create()
    {
        return view('unemployed-form');
    }

    // Guardar nuevo desempleado
    public function agg_unemployed(Request $request)
    {
        $request->validate([
            'profession' => 'required|string|max:255',
            'experience' => 'required|string',
            'location' => 'required|string|max:255'
        ]);

        $unemployed = new Unemployed();
        $unemployed->user_id = Auth::id();
        $unemployed->profession = $request->profession;
        $unemployed->experience = $request->experience;
        $unemployed->location = $request->location;
        $unemployed->save();

        return redirect()->route('home')
                        ->with('success', 'Perfil de desempleado creado exitosamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $unemployed = Unemployed::findOrFail($id);
        
        // Verificar que el usuario sea el dueño del perfil
        if ($unemployed->user_id !== Auth::id()) {
            return redirect()->route('')
                           ->with('error', 'No tienes permiso para editar este perfil.');
        }
        
        return view('home', compact('unemployed'));
    }

    // Actualizar desempleado
    public function update(Request $request, $id)
    {
        $request->validate([
            'profession' => 'required|string|max:255',
            'experience' => 'required|string',
            'location' => 'required|string|max:255',
            'skills' => 'nullable|string',
            'education' => 'nullable|string'
        ]);

        $unemployed = Unemployed::findOrFail($id);
        
        // Verificar que el usuario sea el dueño del perfil
        if ($unemployed->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para editar este perfil.');
        }

        $unemployed->profession = $request->profession;
        $unemployed->experience = $request->experience;
        $unemployed->location = $request->location;
        $unemployed->skills = $request->skills;
        $unemployed->education = $request->education;
        $unemployed->save();

        return redirect()->route('home')
                        ->with('success', 'Perfil actualizado exitosamente.');
    }

    // Eliminar desempleado
    public function destroy($id)
    {
        $unemployed = Unemployed::findOrFail($id);
        
        // Verificar que el usuario sea el dueño del perfil
        if ($unemployed->user_id !== Auth::id()) {
            return redirect()->route('home')
                           ->with('error', 'No tienes permiso para eliminar este perfil.');
        }

        $unemployed->delete();

        return redirect()->route('home')
                        ->with('success', 'Perfil eliminado exitosamente.');
    }
}
