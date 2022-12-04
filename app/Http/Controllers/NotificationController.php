<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationStatus;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNotificationRequest;

class NotificationController extends Controller
{
    public function show()
    {
        $notifications = $this->NotificationsWithReadStatus();

        if (Auth()->user()->role === 'admin') {
            return view('admin.notification', compact('notifications'));
        } else {
            return view('user.notification', compact('notifications'));
        }
    }

    public function create(StoreNotificationRequest $request)
    {
        Notification::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return redirect()->route('admin.show');
    }

    public function notificationStatus(Request $request)
    {
        $request->validate([
            'notificationId' => 'required|integer',
            'userId' => 'required|integer',
        ]);

        NotificationStatus::updateOrCreate([
            'notification_id' => $request->notificationId,
            'read_by_user' => $request->userId
        ]);
        return redirect()->route('admin.show');
    }

    public function unreadNotificationsCount()
    {
        $count = 0;
        $notifications = Notification::all();
        foreach ($notifications as $note) {
            foreach ($note->notificationStatus as $status) {
                $status = $status->read_by_user;
                if ($status == Auth()->id()) {
                    $count++;
                }
            }
        }
        $unreadCount = $notifications->count() - $count;

        return $unreadCount;
    }

    public function NotificationsWithReadStatus()
    {
        $notifications = Notification::all();
        $userRead = NotificationStatus::select('notification_id')->where('read_by_user', Auth()->id())->get();

        foreach ($notifications as $notification) {
            foreach ($userRead as $read) {

                if ($read->notification_id === $notification->id) {
                    $notification->readStatus = true;
                    break;
                } else {
                    $notification->readStatus = false;
                }
            }
        }
        return $notifications;
    }
}
