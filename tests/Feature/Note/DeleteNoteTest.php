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
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('/notes/' . $note->id);

        
        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
        $response->assertRedirectContains('/');
    }

    public function TestDeleteAllNotes()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->delete('/notes/all');
        $this->assertDatabaseMissing('notes', [
            'user_id' => $user->id,
        ]);
        $response->assertRedirectContains('/');
    }
}

?>
