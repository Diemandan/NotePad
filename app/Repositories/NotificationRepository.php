<?php

namespace App\Repositories;

use App\Models\Complaint;
use App\Models\Notification;
use App\Models\NotificationStatus;
use Illuminate\Support\Facades\Cache;

class NotificationRepository
{
    private $cacheComplaintKey;

    private $cacheNotificationKey;

    public function __construct()
    {
        $this->cacheComplaintKey = Auth()->id() . '_' . 'allComplaintsAuthUser';
        $this->cacheNotificationKey = Auth()->id() . '_' . 'allNotificationsAuthUser';
    }

    public function createNotification($request)
    {
        Cache::has($this->cacheNotificationKey) && Cache::forget($this->cacheNotificationKey);

        Notification::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
    }

    public function createNotificationStatus($request)
    {
        Cache::has($this->cacheNotificationKey) && Cache::forget($this->cacheNotificationKey);

        NotificationStatus::updateOrCreate([
            'notification_id' => $request->notificationId,
            'read_by_user' => $request->userId
        ]);
    }

    public function createComplaint($request)
    {
        Cache::has($this->cacheComplaintKey) && Cache::forget($this->cacheComplaintKey);

        Complaint::create([
            'user_id' => $request->userId,
            'description' => $request->complaint,
        ]);
    }

    public function getComplaints()
    {
        if (Cache::has($this->cacheComplaintKey)) {
            return Cache::get($this->cacheComplaintKey);
        } else {
            $allComplaints = Complaint::all();
            Cache::set($this->cacheComplaintKey, $allComplaints, 300);
            return $allComplaints;
        }
    }

    public function getNotifications()
    {
        $allNotifications = Notification::all();

        if (Cache::has($this->cacheNotificationKey)) {
            return Cache::get($this->cacheNotificationKey);
        } else {
            $allNotifications = Complaint::all();
            Cache::set($this->cacheNotificationKey, $allNotifications, 300);
            return $allNotifications;
        }
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
