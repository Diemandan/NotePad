<?php

namespace Tests\Feature;

use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\OrderStatusSeeder;

class NoteTest extends TestCase
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
        $response->assertStatus(200);
    }

    public function testStoreNewNoteWork()
    {
        $this->post('/notes', [
            'name' => 'testName11',
            'description' => 'testDescription',
        ]);
        $this->assertDatabaseHas('notes', [
            'name' => 'testName11',
            'description' => 'testDescription',
        ]);
    }

    public function testRedirectHome()
    {
        $response = $this->post('/notes');
        $response->assertRedirectContains('/');
    }

    public function testValidation()
    {
        $response = $this->post('/notes');
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'description' => 'The description field is required.',
        ]);
    }

    public function testSeedingNotes()
    {
        $this->seed();
        $this->assertDatabaseCount('notes', 10);

    }
}
