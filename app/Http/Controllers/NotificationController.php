<?php

namespace App\Http\Controllers;


use App\Models\Notification;
use App\Models\NotificationStatus;
use App\Models\Complaint;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\StoreComplaintRequest;

class NotificationController extends Controller
{
    public function show()
    {
        $allNotificationsWithReadStatus = $this->notificationsWithReadStatus();

        if (Auth()->user()->role === User::ROLE) {

            return view('admin.notification', compact('allNotificationsWithReadStatus'));
        } else {

            return view('user.notification', compact('allNotificationsWithReadStatus'));
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
        NotificationStatus::updateOrCreate([
            'notification_id' => $request->notificationId,
            'read_by_user' => $request->userId
        ]);

        return redirect()->route('admin.show');
    }

    public function createComplaint(StoreComplaintRequest $request)
    {
        Complaint::create([
            'user_id' => $request->userId,
            'description' => $request->complaint,
        ]);

        return redirect()->route('home');
    }

    public function showComplaints()
    {
        $complaints = Complaint::all();

        return view('admin.complaints', compact('complaints'));
    }

    public function getUnreadNotificationsCount()
    {
        $notificationsAll = Notification::all();
        $notificationWithReadStatus = Notification::whereIn('id', $this->getReadNotificationIds())->get();

        $unreadCount = $notificationsAll->diff($notificationWithReadStatus)->count();

        return $unreadCount;
    }

    public function notificationsWithReadStatus()
    {
        $notifications = Notification::all();

        $arrayOfIds = $this->getReadNotificationIds();

        foreach ($notifications as $notification) {

            $checkReadNotificationsExist = array_search($notification->id, $arrayOfIds);

            if ($checkReadNotificationsExist or $checkReadNotificationsExist === 0)

                $notification->readStatus = true;
        }

        return $notifications;
    }

    public function getReadNotificationIds()
    {
        $idOfReadNotifications = NotificationStatus::userReadNotes()->modelKeys();

        return $idOfReadNotifications;
    }
}
