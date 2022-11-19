<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Note;
use App\Models\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentSaveTest extends TestCase
{
    use RefreshDatabase;

    public function testTxtCanBeUploaded()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();
        $comment = Comment::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])
            ->get('/notes/{' . $note->id .'}/comments/txt');
      
        $response->assertDownload();       
    }

    public function test_console_command()
    {
    $this->artisan('notepad:dump')->assertExitCode(0);
    }
}