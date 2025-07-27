<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users=User::included()->filter()->sort()->getOrPaginate();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $created = User::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = User::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = User::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
