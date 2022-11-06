<?php

namespace Tests\Feature\Note;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class UpdateNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateNoteWork()
    {
        
        $user = User::factory()->create();
        $newNote = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/notes', [
                'name' => 'testName1',
                'description' => 'testDescription1',
                ]);

        $note=DB::table('notes')
        ->where('name', 'testName1')
        ->first();

        $editNote = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->put('/notes', [
                'name' => 'testName3',
                'description' => 'testDescription1',
                'note_id' => $note->id,
                ]);

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'name' => 'testName3',
            'description' => 'testDescription1',
        ]);
    }
}

?>