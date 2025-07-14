<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites=Favorite::included()->filter()->sort()->getOrPaginate();
        return response()->json($favorites);
    }

    public function store(Request $request)
    {
        $created = Favorite::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Favorite::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Favorite::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Favorite::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
