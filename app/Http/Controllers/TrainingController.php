<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    // Muestra todas las capacitaciones
    public function index()
    {
        $trainings = Training::all();
        return view('training.index', compact('trainings'));
        


        
    }

    // Muestra el formulario de creación
    public function create()
    {
        return view('training.create');
    }

    // Guarda una nueva capacitación
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Crea una nueva capacitación
        Training::create($request->all());

        // Redirige con un mensaje de éxito
        return redirect()->route('training.index')->with('success', 'Capacitación registrada correctamente.');
    }

    // Muestra el formulario de edición para una capacitación específica
    public function edit($id)
    {
        $training = Training::findOrFail($id);
        return view('training.edit', compact('training'));
    }

    // Actualiza una capacitación
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Encuentra y actualiza la capacitación
        $training = Training::findOrFail($id);
        $training->update($request->all());

        // Redirige con un mensaje de éxito
        return redirect()->route('training.index')->with('success', 'Capacitación actualizada correctamente.');
    }

    // Elimina una capacitación
    public function destroy($id)
    {
        $training = Training::findOrFail($id);
        $training->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('training.index')->with('success', 'Capacitación eliminada correctamente.');
    }
    

public function inscribir(Request $request, $id)
{
    $request->validate([
        'fecha_inscripcion' => 'required|date',
        'completado' => 'required|boolean',
        'cesante_id' => 'required|integer',
    ]);

    $training = Training::findOrFail($id);

    $training->update([
        'fecha_inscripcion' => $request->fecha_inscripcion,
        'completado' => $request->completado,
        'cesante_id' => $request->cesante_id,
    ]);

    return redirect()->route('training.inscripciones')->with('success', '¡Inscripción guardada!');
}

public function inscripciones()
{
    $trainings = Training::all();
    return view('training.inscripciones', compact('trainings'));
}
}
