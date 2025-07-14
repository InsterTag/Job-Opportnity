<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classified;

class ClassifiedController extends Controller
{
    public function index()
    {
        $classifieds=Classified::included()->filter()->sort()->getOrPaginate();
        return response()->json($classifieds);
    }

    public function store(Request $request)
    {
        $created = Classified::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Classified::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Classified::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Classified::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
