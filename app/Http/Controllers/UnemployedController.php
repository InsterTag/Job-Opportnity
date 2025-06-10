<?php

namespace App\Http\Controllers;
use App\Models\Unemployed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnemployedController extends Controller
{
    public function create() {
        return view('Unemployed-form');
    }

    public function agg_unemployed(Request $request) {
    $request->validate([
        'profession' => ['required', 'string', 'max:255'],
        'experience' => ['required', 'string'],
        'location' => ['required', 'string', 'max:255'],
    ]);

    $unemployed = new Unemployed(); 
    $unemployed->user_id = Auth::user()->id;
    $unemployed->profession = $request->profession;
    $unemployed->experience = $request->experience;
    $unemployed->location = $request->location;
    $unemployed->save();

    return redirect()->route('home')->with('success', 'Usuario registrado correctamente.');
}
    
}