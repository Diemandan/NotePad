<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Comment;
use App\Exports\CommentExport;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CommentController extends Controller
{
  public function show(Request $request, $id)
  {
    $comments=Comment::where('note_id',$id)->orderBy('id','desc')->get();
    
    return view('comment', [
      'note_id' => $id,
      'user_id' => auth()->id(),
      'comments' => $comments,
    ]);
  }

  public function savetext(Request $request, $id)
  {
    $content='';
    $comments = Comment::where('note_id', $id)->get();
      foreach ($comments as $comment ) {
        $content.=  $comment->text .PHP_EOL ;
      }
    
    Storage::put('comments.txt', $content);

    return Storage::download('comments.txt', 'base txt_copy');
    //return response()->download('/var/www/notepad/storage/app/comments.txt', 'base txt_copy');
  }

  public function saveexcel(Request $request, $id)
  {
    return  Excel::download(new CommentExport($id), 'comments.xlsx');
  }


  public function create(StoreCommentRequest $request)
  {
    Comment::create([
      'note_id' => $request->input('note_id'),
      'user_id' =>$request->input('user_id'),
      'text' => $request->input('text'), 
    ]);
   
    return redirect()->route('show',['id' => $request->input('note_id')])
      ->with('success', 'Comment created.');
  }

  public function delete(Request $request, $id, $comment_id)
  {
    Comment::where('id', $comment_id)->delete();

    return redirect()->route('show',['id'=>$id])->with('success', 'Comment deleted.');
  }
}
