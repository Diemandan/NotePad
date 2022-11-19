<?php

namespace Tests\Feature\Note;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationNewNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testValidationNewNote()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->post('/notes');
        
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'description' => 'The description field is required.',
        ]);
    }
}
?>
