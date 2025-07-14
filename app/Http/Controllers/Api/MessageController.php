<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages=Message::included()->filter()->sort()->getOrPaginate();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $created = Message::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Message::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Message::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Message::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
