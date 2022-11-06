<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
Use App\Http\Controllers\Auth\ConfirmablePasswordController;

class NoteController extends Controller
{
  public function index(Request $request)
  {
    $data = auth()->id();
    $notes = Note::all()
      ->sortBy('updated_at')
      ->where('user_id', $data);

    return view('home', ['notes' => $notes, 'data' => $data]);
  }

  public function store(StoreNoteRequest $request)
  {
    $note = new Note();
    $note->name = $request->input('name');
    $note->description = $request->input('description');
    $note->user_id = auth()->id();
    $note->save();

    return redirect()
      ->route('home')
      ->with('success', 'Note created.');
  }

  public function editNote(StoreNoteRequest $request){}

  public function show(Request $request,$id){
    $note = DB::table('notes')->where('id', $id)->first();
    return view('note', ['note' => $note]);
  }

  public function delete(Request $request, $id)
  {
    DB::table('notes')
      ->where('id', '=', $id)
      ->delete();
    return redirect()
      ->route('home')
      ->with('success', 'Note deleted.');
  }

  public function deleteAll(Request $request)
  {
    $user_id = auth()->id();
    
    DB::table('notes')
      ->where('user_id', '=', $user_id)
      ->delete();
    return redirect()
      ->route('home')
      ->with('success', 'All Notes deleted.');
  }
}
