<?php

namespace App\Http\Controllers;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
 // Mostrar el formulario para agregar un portafolio
    public function create()
    {
        return view('portfolio.create');
    }

    // Guardar un nuevo portafolio
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file_url' => 'required|string',
        ]);

        $portfolio = new Portfolio();
        $portfolio->unemployed_id = Auth::user()->unemployed->id;
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;
        $portfolio->file_url = $request->file_url;
        $portfolio->save();

        return redirect()->route('portfolio-list');
    }

    // Mostrar la lista de portafolios
    public function list()
    {
        $portfolios = Portfolio::where('unemployed_id', Auth::user()->unemployed->id)->get();
        return view('portfolio.list', compact('portfolios'));
    }

    // Mostrar el formulario para editar un portafolio
    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('portfolio.edit', compact('portfolio'));
    }

    // Actualizar un portafolio
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file_url' => 'required|string',
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;
        $portfolio->file_url = $request->file_url;
        $portfolio->save();

        return redirect()->route('portfolio-list');
    }

    // Eliminar un portafolio
    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();

        return redirect()->route('portfolio-list');
    }
}
