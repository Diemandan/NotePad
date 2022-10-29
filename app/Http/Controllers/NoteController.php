<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;


class NoteController extends Controller
{
  public function index()
  {
    $notes = Note::all()->sortBy('updated_at');
 
    return view('home', ['notes' => $notes]);
  }
  public function store(StoreNoteRequest $request)
  {
    $note = new Note();
    $note->name = $request->input('name');
    $note->description = $request->input('description');
    $note->save();
    
   return redirect()->route('home') ;
  }
}
