<?php

namespace Tests\Feature\Note;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

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
        $response = $this->post('/notes');
        $response->assertRedirectContains('/');
    }

    public function testSeedingNotes()
    {
        $this->seed();
        $this->assertDatabaseCount('notes', 10);
    }
}
