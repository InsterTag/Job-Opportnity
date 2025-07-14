<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications=Notification::included()->filter()->sort()->getOrPaginate();
        return response()->json($notifications);
    }

    public function store(Request $request)
    {
        $created = Notification::create($request->all());
        return response()->json($created, 201);
    }

    public function show($id)
    {
        $item = Notification::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Notification::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Notification::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
