<?php

namespace App\Http\Controllers;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        $notifications = Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('notifications.index', compact('notifications'));
    }

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

    public function markAsRead($id) {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();
        
        if ($notification) {
            $notification->read = true;
            $notification->save();
        }
        
        return response()->json(['success' => true]);
    }

    public function getUnreadCount() {
        $count = Notification::where('user_id', auth()->id())
            ->where('read', false)
            ->count();
        
        return response()->json(['count' => $count]);
    }
}
