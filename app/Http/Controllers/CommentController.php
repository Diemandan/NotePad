<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
  public function show(Request $request, $id)
  {
    $note = Note::find($id);
    $comments = $note->comments;
    return view('comment', [
      'note_id' => $id,
      'user_id' => auth()->id(),
      'comments' => $comments,
    ]);
  }

  public function create(StoreCommentRequest $request)
  {
    $comment = new Comment();
    $comment->note_id = $request->input('note_id');
    $comment->user_id = $request->input('user_id');
    $comment->text = $request->input('text');
    $comment->save();

    return redirect()
      ->route('show',['id'=>$request->input('note_id')])
      ->with('success', 'Comment created.');
  }

  public function delete(Request $request, $id,$comment_id)
  {
    DB::table('comments')
      ->where('id', '=', $comment_id)
      ->delete();
    return redirect()
      ->route('show',['id'=>$id])
      ->with('success', 'Comment deleted.');
  }

}
