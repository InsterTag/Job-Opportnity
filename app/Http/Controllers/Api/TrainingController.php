<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings=Training::included()->filter()->sort()->getOrPaginate();
        return response()->json($trainings);
    }

    public function store(Request $request)
    {
        $created = Training::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Training::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Training::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Training::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
