<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('Category-form');
    }

    public function agg_category(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:500', 
            'is_active' => 'sometimes|boolean' 
        ]);

        $category = Category::create($validatedData);

        return redirect()
                ->route('categories.index') 
                ->with('success', 'Category created successfully');
    }
}