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
        $notes = Note::where('user_id', auth()->id())->get();

        if ($request->has('sort')) {
            $notes = Note::where('user_id', auth()->id())
                ->orderBy('created_at', $request->sort)->get();
        }
        if ($request->has('priority')) {
            $notes = $notes->where('priority', $request->priority);
        }

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
            'priority' => $request->input('priority'),
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Note created.');
    }

    public function update(StoreNoteRequest $request)
    {
        $noteId = $request->input('note_id');

        Note::where('id', $noteId)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
        ]);

        return redirect()
            ->route('show', ['id' => $noteId])
            ->with('success', 'Note edit success.');
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

        return redirect()
            ->route('home')
            ->with('success', 'Note deleted with comments.');
    }

    public function deleteAll()
    {
        $userId = auth()->id();
        Note::where('user_id', '=', $userId)->delete();
        Comment::where('user_id', '=', $userId)->delete();

        return redirect()
            ->route('home')
            ->with('success', 'All Notes deleted with their comments.');
    }

    public function downloadText()
    {
        $notes = Note::where('user_id', auth()->id())->get();
        $content = '';

        foreach ($notes as $note) {
            $content .= $note->name . ':' . $note->description . PHP_EOL;
        }

        Storage::put('notes' . auth()->id() . '.txt', $content);
        $filepath = '/var/www/notepad/storage/app/notes' . auth()->id() . '.txt';

        return response()
            ->download($filepath, 'base txt_copy' . auth()->id())
            ->deleteFileAfterSend(true);
    }

    public function downloadExcel()
    {
        return Excel::download(new NoteExport(auth()->id()), 'notes' . auth()->id() . '.xlsx');
    }
}
