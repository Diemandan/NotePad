<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $response->assertViewHas('notifications.0.title', $notification->title);
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
}
