<?php

namespace App\Services;

use App\Repositories\NoteRepository;
use Illuminate\Support\Facades\Storage;

class NoteService
{
    private $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function downloadText($request)
    {
        $notes = $this->noteRepository->getAllNotesAuthUser($request);

        $content = '';

        foreach ($notes as $note) {
            $content .= $note->name . ':' . $note->description . PHP_EOL;
        }

        Storage::put('notes' . auth()->id() . '.txt', $content);
    }
}
