<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    private static $notifications = [
        [
            'id' => 1,
            'title' => 'First Notification',
            'description' => 'This is the first notification.',
            'is_read' => false,
            'priority' => 1,
        ],
        [
            'id' => 2,
            'title' => 'Second Notification',
            'description' => 'This is the second notification.',
            'is_read' => false,
            'priority' => 2,
        ],
    ];

    public function getNotifications()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'notifications' => self::$notifications,
            ],
        ]);
    }

    public function markNotificationAsRead(Request $request, $notificationId)
    {
        $request->validate([
            'read_at' => 'required|date',
        ]);

        $readAt = $request->input('read_at');
        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'Notification marked as read successfully'
            ],
        ]);
    }
}
