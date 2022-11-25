<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Note;
use App\Models\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteSaveTest extends TestCase
{
    use RefreshDatabase;

    public function testTxtCanBeUploaded()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();

        $response = $this->actingAs($user)
            ->withSession(['banned' => false])
            ->get('/notes/txt');

        $response->assertDownload();
    }

    public function testConsoleCommand()
    {
        $this->artisan('notepad:dump')->assertExitCode(0);
    }
}
