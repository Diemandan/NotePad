<?php

namespace Tests\Feature\Note;

use App\Models\User;
use App\Models\Note;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

class ShowNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testShowNote()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->get('/notes/' . $note->id);

        $response->assertStatus(200);
    }

    public function testCorrectAnswer()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->get('/notes/' . $note->id);

        $data = $response->getOriginalContent()->getData();

        $this->assertSame($note->id, $data['note']['id']);
    }

    public function testIncorrectResponse()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->get('/notes/' . ($note->id + 1));

        $response->assertStatus(500);
    }

    public function testShowCorrectPriority()
    {
        $user = User::factory()->create(['id' => 1]);
        $notes = [Note::factory()->create(['user_id' => 1, 'id' => 19, 'priority' => 'low']), Note::factory()->create(['user_id' => 1, 'id' => 20]), Note::factory()->create(['user_id' => 1, 'id' => 21])];

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->get('/?priority=low');
            
        $this->assertSame('low', $response['notes'][0]['priority']);
    }
}
