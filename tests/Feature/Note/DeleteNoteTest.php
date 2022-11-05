<?php

namespace Tests\Feature\Note;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteNote()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();
        $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/');

        $response = $this->post('/notes/' . $note->id);
        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
        $response->assertRedirectContains('/');
    }
}

?>
