<?php

namespace Tests\Feature\Note;

use App\Models\User;
use App\Models\Note;
use App\Models\Comment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCommentTest extends TestCase
{
    use RefreshDatabase;

    public function testDeleteComment()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->delete('/notes/' . $note->id . '/comments/' . $comment->id);
        
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
        
        $response->assertRedirectContains('/notes/'.$note->id);
    }
}