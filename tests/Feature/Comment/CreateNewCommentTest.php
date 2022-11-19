<?php

namespace Tests\Feature\Note;

use App\Models\User;
use App\Models\Note;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateNewCommentTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreNewCommentWork()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->post('/notes/'.$note->id . '/comments', [
                'note_id' => $note->id,
                'text' => 'qwerty',
                'user_id' => auth()->id(),
            ]);

        $this->assertDatabaseHas('comments', [
            'note_id' => $note->id,
                'text' => 'qwerty',
                'user_id' => auth()->id(),
        ]);

        $response->assertRedirectContains(route('show',['id'=>$note->id]));
    }
}

?>
