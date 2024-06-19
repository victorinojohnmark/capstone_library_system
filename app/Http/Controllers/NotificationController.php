<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('system.notification.notification-view', [
            'notifications' => auth()->user()->unreadNotifications
        ]);
    }

    public function get()
    {
        // return auth()->user()->notifications;
        return [
            'label' => count(auth()->user()->unreadNotifications),
            'label_color' => 'danger',
            'icon_color' => 'dark',
            // 'dropdown' => $dropdownHtml,
        ];
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
