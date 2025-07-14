<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingUser;

class TrainingUserController extends Controller
{
    public function index()
    {
        $trainingsusers=TrainingUser::included()->filter()->sort()->getOrPaginate();
        return response()->json($trainingsusers);
    }

    public function store(Request $request)
    {
        $created = TrainingUser::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = TrainingUser::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = TrainingUser::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = TrainingUser::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
