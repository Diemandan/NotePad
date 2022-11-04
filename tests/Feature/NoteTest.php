<?php

namespace Tests\Feature;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\OrderStatusSeeder;
use Illuminate\Support\Facades\Http;

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
        $response->assertRedirect('/login');
    }

    public function testStoreNewNoteWork()
     { 
        $user = User::factory()->create();
        $response = $this->actingAs($user) ->withSession(['banned' => false])
                         ->get('/');
        
        $this->post('http://notepad/notes', [
            
            'name' => 'testName1',
            'description' => 'testDescription1',
            'user_id' => auth()->id(),
        ]);
        $this->assertDatabaseHas('notes', [
            'user_id' => auth()->id(),
            'name' => 'testName1',  
            'description' => 'testDescription1',
        ]);
    }

    public function testRedirectHome()
    {
        $response = $this->post('/notes');
        $response->assertRedirectContains('/');
    }

    public function testValidationNewNote()
    {
        $user = User::factory()->create();
        $auth = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
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
