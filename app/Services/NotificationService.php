<?php

namespace App\Services;

use App\Repositories\NotificationRepository;

class NotificationService
{
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getUnreadNotificationsCount()
    {
        $notificationsAll = $this->notificationRepository->getNotifications();
        $notificationWithReadStatus = $this->notificationRepository->notificationsWithReadStatus();

        $unreadCount = $notificationsAll->diff($notificationWithReadStatus)->count();

        return $unreadCount;
    }

    public function notificationsWithReadStatus()
    {
        $notifications = $this->notificationRepository->getNotifications();

        $arrayOfIds = $this->notificationRepository->getReadNotificationIds();

        foreach ($notifications as $notification) {

            $checkReadNotificationsExist = array_search($notification->id, $arrayOfIds);

            if ($checkReadNotificationsExist or $checkReadNotificationsExist === 0)

                $notification->readStatus = true;
        }

        return $notifications;
    }
}
