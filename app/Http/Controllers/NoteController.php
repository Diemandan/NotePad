<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Comment;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;


class NoteController extends Controller
{
  public function index(Request $request)
  {
    $notes = Note::where('user_id', auth()->id())->latest()->get();

    return view('home', ['notes' => $notes]);
  }

  public function create(Request $request)
  {
    return view('createnote');
  }

  public function store(StoreNoteRequest $request)
  {
    $note_id = $request->input('note_id');
    if (Note::where('id', $note_id)->exists()) 
      {
        Note::where('id', $note_id)->update([
          'name' => $request->input('name'),
          'description' => $request->input('description'),
        ]);

      return redirect()->route('show', ['id' => $note_id])->with('success', 'Note edit success.');
    } else {
      Note::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'user_id' => auth()->id()]);
     
      return redirect()->route('home')->with('success', 'Note created.');
    }
  }

  public function edit(Request $request, $id)
  {
    $note = Note::where('id', $id)->first();

    return view('editnote', ['note' => $note]);
  }

  public function show(Request $request, $id)
  {
    $note = Note::find($id);
    $comments = $note->comments;

    return view('note', ['note' => $note, 'comments' => $comments]);
  }

  public function delete(Request $request, $id)
  {
    Note::where('id', '=', $id)->delete();
    Comment::where('note_id', '=', $id)->delete();

    return redirect()->route('home')->with('success', 'Note deleted with comments.');
  }

  public function deleteAll(Request $request)
  {
    $user_id = auth()->id();
    Note::where('user_id', '=', $user_id)->delete();
    Comment::where('user_id', '=', $user_id)->delete();

    return redirect()->route('home')->with('success', 'All Notes deleted with their comments.');
  }
}
