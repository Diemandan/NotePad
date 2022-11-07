<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;

use App\Models\Note;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
  public function index(Request $request)
  {
    $data = auth()->id();
    $notes = DB::table('notes')
      ->where('user_id', $data)
      ->latest()
      ->get();

    return view('home', ['notes' => $notes, 'data' => $data]);
  }

  public function create(Request $request)
  {
    return view('createnote');
  }

  public function store(StoreNoteRequest $request)
  {
    $note_id = $request->input('note_id');
    if (
      DB::table('notes')
        ->where('id', $note_id)
        ->exists()
    ) {
      DB::table('notes')
        ->where('id', $note_id)
        ->update([
          'name' => $request->input('name'),
          'description' => $request->input('description'),
        ]);

      return redirect()
        ->route('show', ['id' => $note_id])
        ->with('success', 'Note edit success.');
    } else {
      $note = new Note();
      $note->name = $request->input('name');
      $note->description = $request->input('description');
      $note->user_id = auth()->id();
      $note->save();

      return redirect()
        ->route('home')
        ->with('success', 'Note created.');
    }
  }

  public function edit(Request $request, $id)
  {
    $note = DB::table('notes')
      ->where('id', $id)
      ->first();
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
    DB::table('notes')
      ->where('id', '=', $id)
      ->delete();

      DB::table('comments')
      ->where('note_id', '=', $id)
      ->delete();

    return redirect()
      ->route('home')
      ->with('success', 'Note deleted with comments.');
  }

  public function deleteAll(Request $request)
  {
    $user_id = auth()->id();

    DB::table('notes')
      ->where('user_id', '=', $user_id)
      ->delete();
      DB::table('comments')
      ->where('user_id', '=', $user_id)
      ->delete();

    return redirect()
      ->route('home')
      ->with('success', 'All Notes deleted with their comments.');
  }
}
