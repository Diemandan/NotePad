<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Note;
use Illuminate\Support\Facades\Cache;

class NoteRepository
{

    private $cacheKey;

    public function __construct()
    {
        $this->cacheKey = Auth()->id() . '_' . 'allNotesAuthUser';
    }

    public function getNote($id)
    {
        return Note::find($id);
    }


    public function getAllNotesAuthUser($request)
    {
        $notes = Note::where('user_id', auth()->id());

        if ($request->has('sort')) {
            $notes = $notes->orderBy('created_at', $request->sort);
        }

        if ($request->has('priority')) {
            $notes = $notes->where('priority', $request->priority);
        }

        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        } else {
            $notes = $notes->get();
            Cache::set($this->cacheKey, $notes, 300);

            return $notes;
        }
    }

    public function createNote($request)
    {
        Note::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
            'remind_at' => $request->input('remind_at'),
            'priority' => $request->input('priority'),
        ]);

        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);
    }

    public function updateNote($noteId, $request)
    {
        Note::where('id', $noteId)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
        ]);

        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);
    }

    public function deleteNote($id)
    {
        Note::where('id', '=', $id)->delete();
        Comment::where('note_id', '=', $id)->delete();

        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);
    }

    public function deleteAllUsersNotes()
    {
        $userId = auth()->id();

        Note::where('user_id', '=', $userId)->delete();
        Comment::where('user_id', '=', $userId)->delete();

        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);
    }
}
