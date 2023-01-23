<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Http\Requests\StoreCommentRequest;


class CommentController extends Controller
{
  public function show($id)
  {
    $comments = Comment::where('note_id', $id)
      ->orderBy('id', 'desc')
      ->get();

    return view('comment', [
      'note_id' => $id,
      'user_id' => auth()->id(),
      'comments' => $comments,
    ]);
  }

  public function create(StoreCommentRequest $request)
  {
    Comment::create([
      'note_id' => $request->input('note_id'),
      'user_id' => $request->input('user_id'),
      'text' => $request->input('text'),
    ]);

    return redirect()
      ->route('show', ['id' => $request->input('note_id')])
      ->with('success', 'Comment created.');
  }

  public function delete($id, $comment_id)
  {
    Comment::where('id', $comment_id)->delete();

    return redirect()
      ->route('show', ['id' => $id])
      ->with('success', 'Comment deleted.');
  }
}
