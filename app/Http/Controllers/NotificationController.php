<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function create() {
        return view('Notification-form');
    }

    public function agg_notification(Request $request) {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'message' => 'required|string|max:500',
            
        ]);

        $notification = new Notification();
        $notification->user_id = $validatedData['user_id'];
        $notification->message = $validatedData['message'];
        $notification->read = false; 
        $notification->save();

        return $notification;
    }
}