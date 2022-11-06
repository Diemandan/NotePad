<?php

namespace Tests\Feature\Note;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreNewNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreNewNoteWork()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->post('/notes', [
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
}

?>
