<?php

namespace App\Repositories;

use App\Models\Complaint;
use App\Models\Notification;
use App\Models\NotificationStatus;

class NotificationRepository
{
    public function createNotification($request)
    {
        Notification::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
    }

    public function createNotificationStatus($request)
    {
        NotificationStatus::updateOrCreate([
            'notification_id' => $request->notificationId,
            'read_by_user' => $request->userId
        ]);
    }

    public function createComplaint($request)
    {
        Complaint::create([
            'user_id' => $request->userId,
            'description' => $request->complaint,
        ]);
    }

    public function getComplaints()
    {
        return Complaint::all();
    }

    public function getNotifications()
    {
        return Notification::all();
    }

    public function getReadNotificationIds()
    {
        return NotificationStatus::userReadNotes()->modelKeys();
    }

    public function notificationsWithReadStatus()
    {
        return Notification::whereIn('id', $this->getReadNotificationIds())->get();
    }
}
