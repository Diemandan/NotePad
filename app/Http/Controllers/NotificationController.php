<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\StoreComplaintRequest;
use App\Repositories\NotificationRepository;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    public function show(NotificationService $notificationService)
    {
        $allNotificationsWithReadStatus = $notificationService->notificationsWithReadStatus();

        if (Auth()->user()->role === User::ROLE) {

            return view('admin.notification', compact('allNotificationsWithReadStatus'));
        } else {

            return view('user.notification', compact('allNotificationsWithReadStatus'));
        }
    }

    public function create(NotificationRepository $notificationRepository, StoreNotificationRequest $request)
    {
        $notificationRepository->createNotification($request);

        return redirect()->route('admin.show');
    }

    public function notificationStatus(NotificationRepository $notificationRepository, Request $request)
    {
        $notificationRepository->createNotificationStatus($request);

        return redirect()->route('admin.show');
    }

    public function createComplaint(NotificationRepository $notificationRepository, StoreComplaintRequest $request)
    {
        $notificationRepository->createComplaint($request);


        return redirect()->route('home');
    }

    public function showComplaints(NotificationRepository $notificationRepository)
    {
        $complaints = $notificationRepository->getComplaints();

        return view('admin.complaints', compact('complaints'));
    }
}
