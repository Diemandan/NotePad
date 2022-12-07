<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Models\NotificationStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function testCorrectView()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->withSession(['banned' => false])
            ->get('/admin');

        $response->assertViewIs('admin.customerUsers');
    }

    public function testCorrectAnswer()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $notification = Notification::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->get('/admin/notifications');

        $response->assertViewHas('allNotificationsWithReadStatus.0.title', $notification->title);
    }

    public function testStoreNewNoteWork()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->post('/admin/notifications', [
                'title' => 'testName1',
                'description' => 'testDescription1',
            ]);

        $this->assertDatabaseHas('notifications', [
            'title' => 'testName1',
            'description' => 'testDescription1',
        ]);
    }

    public function testShowComplaintView()
    {
        $user = User::factory()->create(['role' => 'customer']);


        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->get('/complaints');

        $response->assertViewIs('user.complaint');
    }

    public function testNotificationStatus()
    {
        $user = User::factory()->create(['role' => 'customer']);
        $notification = Notification::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->post('/admin/notification/status', [
                'notificationId' => $notification->id,
                'userId' => $user->id,
            ]);

        $this->assertDatabaseHas('notification_statuses', [
            'notification_id' => $notification->id,
            'read_by_user' => $user->id,
        ]);
    }

    public function testStoreNewComplaint()
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->post('/complaints', [
                'userId' => $user->id,
                'complaint' => 'testDescription1',
            ]);

        $this->assertDatabaseHas('complaints', [
            'user_id' => $user->id,
            'description' => 'testDescription1',
        ]);
    }
}
