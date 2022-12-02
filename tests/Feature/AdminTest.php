<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Note;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdminPageAvailable()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->withSession(['banned' => false])->get('/admin');

        $response->assertStatus(200);
    }

    public function testAdminPageRedirectIfNotAdmin()
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->withSession(['banned' => false])->get('/admin');

        $response->assertRedirect(route('home'));
    }

    public function testCorrectAnswer()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($admin)->withSession(['banned' => false])
            ->get('/admin');

        $this->assertSame($user->role, $response['users'][0]['role']);
    }

    public function testDeleteUser()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();


        $response = $this->actingAs($admin)->withSession(['banned' => false])
            ->delete('/admin/' . $user->id);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function testChangeStatusUser()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'customer', 'is_active' => 0]);

        $response = $this->actingAs($admin)->withSession(['banned' => false])
            ->put('/admin/status', [
                'userId' => $user->id,
                'status' => 1,
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'is_active' => 1,
        ]);
    }
}
