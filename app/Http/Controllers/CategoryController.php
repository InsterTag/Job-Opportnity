<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Mostrar el formulario para agregar una categoría
    public function create()
    {
        return view('category.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category-list');
    }

    // Mostrar la lista de categorías
    public function list()
    {
        $categories = Category::all();
        return view('category.list', compact('categories'));
    }

    // Mostrar el formulario para editar una categoría
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    // Actualizar una categoría
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category-list');
    }

    // Eliminar una categoría
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category-list');
    }
}
