<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function getComments($id)
    {
        return Comment::where('note_id', $id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function createComment($request)
    {
        Comment::create([
            'note_id' => $request->input('note_id'),
            'user_id' => $request->input('user_id'),
            'text' => $request->input('text'),
        ]);
    }

    public function deleteComment($comment_id)
    {
        Comment::where('id', $comment_id)->delete();
    }
}
