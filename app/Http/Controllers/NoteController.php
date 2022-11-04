<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;


class NoteController extends Controller
{
  public function index(Request $request)
  {$data = auth()->id();
    $notes = Note::all()->sortBy('updated_at')->where('user_id',$data);
 
    return view('home', ['notes' => $notes,'data'=>$data]);
  }
  public function store(StoreNoteRequest $request)
  {
    $note = new Note();
    $note->name = $request->input('name');
    $note->description = $request->input('description');
    $note->user_id = auth()->id();
    // $note->user_id = $request->input('user_id');
    $note->save();
    
   return redirect()->route('home')->with('success', 'Note created.') ;
  }
}
