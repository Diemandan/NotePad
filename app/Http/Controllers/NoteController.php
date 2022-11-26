<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Comment;
use App\Exports\NoteExport;

use App\Http\Requests\StoreNoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class NoteController extends Controller
{
  public function index(Request $request)
  {
    if (!$request->sort) {
      $sort = 'asc';
    } else {
      $sort = $request->sort;
    }
    $notes = Note::where('user_id', auth()->id())->orderBy('created_at', $sort)->get();

    return view('home', ['notes' => $notes]);
  }

  public function create()
  {
    return view('createnote');
  }

  public function store(StoreNoteRequest $request)
  {
    Note::create([
      'name' => $request->input('name'),
      'description' => $request->input('description'),
      'user_id' => auth()->id(),
      'remind_at' => $request->input('remind_at'),
    ]);

    return redirect()->route('home')->with('success', 'Note created.');
  }

  public function update(StoreNoteRequest $request)
  {
    $note_id = $request->input('note_id');

    Note::where('id', $note_id)->update([
      'name' => $request->input('name'),
      'description' => $request->input('description'),
    ]);

    return redirect()->route('show', ['id' => $note_id])->with('success', 'Note edit success.');
  }

  public function edit($id)
  {
    $note = Note::where('id', $id)->first();

    return view('editnote', ['note' => $note]);
  }

  public function show($id)
  {
    $note = Note::find($id);
    $comments = $note->comments;

    return view('note', ['note' => $note, 'comments' => $comments]);
  }

  public function delete($id)
  {
    Note::where('id', '=', $id)->delete();
    Comment::where('note_id', '=', $id)->delete();

    return redirect()->route('home')->with('success', 'Note deleted with comments.');
  }

  public function deleteAll()
  {
    $user_id = auth()->id();
    Note::where('user_id', '=', $user_id)->delete();
    Comment::where('user_id', '=', $user_id)->delete();

    return redirect()->route('home')->with('success', 'All Notes deleted with their comments.');
  }

  public function saveText()
  {
    $notes = Note::where('user_id', auth()->id())->get();
    $content = '';

    foreach ($notes as $note) {
      $content .= $note->name . ':' . $note->description . PHP_EOL;
    }

    Storage::put('notes.txt', $content);
    $filepath = '/var/www/notepad/storage/app/notes.txt';

    return response()->download($filepath, 'base txt_copy')->deleteFileAfterSend(true);
  }

  public function saveExcel()
  {
    return Excel::download(new NoteExport(auth()->id()), 'comments.xlsx');
  }
}
