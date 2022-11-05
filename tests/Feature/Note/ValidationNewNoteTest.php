<?php

namespace Tests\Feature\Note;
use App\Models\User;
use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationNewNoteTest extends TestCase
{
    use RefreshDatabase;

    public function testValidationNewNote()
    {
        $user = User::factory()->create();
        $auth = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->post('/notes');
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
            'description' => 'The description field is required.',
        ]);
    }
}
?>
