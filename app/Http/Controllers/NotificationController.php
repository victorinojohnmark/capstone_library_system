<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('system.notification.notification-view', [
            'notifications' => auth()->user()->notifications
        ]);
    }
}
