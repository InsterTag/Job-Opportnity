<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create() {
        return view('Notification-form');
    }

    public function agg_notification(Request $request) {
        $notification = new Notification();
        $notification->user_id = $request->user_id;
        $notification->message = $request->message;
        $notification->read = false;
        $notification->save();

        return $notification;
    }
}
