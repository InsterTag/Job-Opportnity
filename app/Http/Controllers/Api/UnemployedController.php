<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unemployed;

class UnemployedController extends Controller
{
    public function index()
    {
        $unemployeds=Unemployed::included()->filter()->sort()->getOrPaginate();
        return response()->json($unemployeds);
    }

    public function store(Request $request)
    {
        $created = Unemployed::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Unemployed::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Unemployed::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Unemployed::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
