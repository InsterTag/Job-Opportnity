<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function index()
    {
        $aplicationss=JobApplication::included()->filter()->sort()->getOrPaginate();
        return response()->json($aplicationss);
    }

    public function store(Request $request)
    {
        $created = JobApplication::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = JobApplication::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = JobApplication::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = JobApplication::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
