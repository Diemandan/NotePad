<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show()
    {
        $notifications = Notification::all();
        if (Auth()->user()->role === 'admin') {
            return view('admin.notification', compact('notifications'));
        } else {
            return view('user.notification', compact('notifications'));
        }
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:35',
            'description' => 'required|max:150',
        ]);
        Notification::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect()->route('admin.show');
    }
}
