<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
  public function show(CommentRepository $commentRepository, $id)
  {
    $comments = $commentRepository->getComments($id);

    return view('comment', [
      'note_id' => $id,
      'user_id' => auth()->id(),
      'comments' => $comments,
    ]);
  }

  public function create(CommentRepository $commentRepository, StoreCommentRequest $request)
  {
    $commentRepository->createComment($request);

    return redirect()
      ->route('show', ['id' => $request->input('note_id')])
      ->with('success', 'Comment created.');
  }

  public function delete(CommentRepository $commentRepository, $id, $comment_id)
  {
    $commentRepository->deleteComment($comment_id);

    return redirect()
      ->route('show', ['id' => $id])
      ->with('success', 'Comment deleted.');
  }
}
