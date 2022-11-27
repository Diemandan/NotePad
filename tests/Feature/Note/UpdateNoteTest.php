<?php

namespace Tests\Feature\Note;

use App\Models\User;
use App\Models\Note;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateNoteWork()
    {       
        $user = User::factory()->create();
        
        $this->actingAs($user)->withSession(['banned' => false])
            ->post('/notes', [
                'name' => 'testName1',
                'description' => 'testDescription1',
                'remind_at' => '2022-11-20',
                'priority' => 'high',
                ]);

        $note=Note::where('name', 'testName1')->select('id')->first();

        $this->actingAs($user)->withSession(['banned' => false])
            ->put('/notes', [
                'name' => 'testName3',
                'description' => 'testDescription1',
                'note_id' => $note->id,
                'remind_at' => '2022-11-20',
                'priority' => 'high',
                ]);

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'name' => 'testName3',
            'description' => 'testDescription1',
            'remind_at' => '2022-11-20',
            'priority' => 'high',
        ]);
    }
}
