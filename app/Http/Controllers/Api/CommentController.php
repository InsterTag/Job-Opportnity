<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comment=Comment::included()->filter()->sort()->getOrPaginate();
        return response()->json($comment);
    }

    public function store(Request $request)
    {
        $created = Comment::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Comment::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Comment::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Comment::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
