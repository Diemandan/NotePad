<?php

namespace Tests\Feature\Note;

use App\Models\User;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class AvailableRedirectSeed extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testStartPageAvailable()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function testRedirectHome()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])->post('/notes');
        
        $response->assertRedirect('/');
    }

    public function testSeedingNotes()
    {
        $this->seed();
        
        $this->assertDatabaseCount('notes', 10);
    }

    public function testCreateNotePageAvailable()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->withSession(['banned' => false])->get('/create');
        
        $response->assertStatus(200);
    }
}
