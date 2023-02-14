<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentRepository
{
    private $cacheKey;

    public function __construct()
    {
        $this->cacheKey = Auth()->id() . '_' . 'NoteComments';
    }

    public function getComments($id)
    {
        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        } else {
            $comments = Comment::where('note_id', $id)
                ->orderBy('id', 'desc')
                ->get();

            Cache::set($this->cacheKey, $comments, 300);

            return $comments;
        }
    }

    public function createComment($request)
    {
        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);

        Comment::create([
            'note_id' => $request->input('note_id'),
            'user_id' => $request->input('user_id'),
            'text' => $request->input('text'),
        ]);
    }

    public function deleteComment($comment_id)
    {
        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);

        Comment::where('id', $comment_id)->delete();
    }
}
