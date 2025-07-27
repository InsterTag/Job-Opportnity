<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $created = Category::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Category::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Category::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
