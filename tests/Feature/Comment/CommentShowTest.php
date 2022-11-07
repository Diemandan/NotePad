<?php

namespace Tests\Feature\Note;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCommentTest extends TestCase
{
    use RefreshDatabase;

    public function testShowComment()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/notes/' . $note->id . '/comments');

        $response->assertStatus(200);
    }
}

?>
