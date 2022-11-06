<?php

namespace Tests\Feature\Note;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testShowNote()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();
        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $response = $this->get('/note/' . $note->id);
        
        $response->assertStatus(200);
    }

    
}

?>
