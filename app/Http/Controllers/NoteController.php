<?php

namespace App\Http\Controllers;

use App\Exports\NoteExport;

use App\Http\Requests\StoreNoteRequest;
use App\Repositories\NoteRepository;
use App\Services\NoteService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class NoteController extends Controller
{
    public function index(NoteRepository $noteRepository, NotificationService $notificationService, Request $request)
    {
        $notes = $noteRepository->getAllNotesAuthUser($request);

        $unreadcount = $notificationService->getUnreadNotificationsCount();

        return view('home', ['notes' => $notes, 'unread' => $unreadcount]);
    }

    public function create()
    {
        return view('createnote');
    }

    public function store(NoteRepository $noteRepository, StoreNoteRequest $request)
    {
        $noteRepository->createNote($request);

        return redirect()
            ->route('home')
            ->with('success', 'Note created.');
    }

    public function update(NoteRepository $noteRepository, StoreNoteRequest $request)
    {
        $noteId = $request->input('note_id');

        $noteRepository->updateNote($noteId, $request);

        return redirect()
            ->route('show', ['id' => $noteId])
            ->with('success', 'Note edit success.');
    }

    public function edit(NoteRepository $noteRepository, $id)
    {
        $note = $noteRepository->getNote($id);

        return view('editnote', ['note' => $note]);
    }

    public function show(NoteRepository $noteRepository, $id)
    {
        $note = $noteRepository->getNote($id);

        $comments = $note->comments;

        return view('note', ['note' => $note, 'comments' => $comments]);
    }

    public function delete(NoteRepository $noteRepository, $id)
    {
        $noteRepository->deleteNote($id);

        return redirect()
            ->route('home')
            ->with('success', 'Note deleted with comments.');
    }

    public function deleteAll(NoteRepository $noteRepository)
    {
        $noteRepository->deleteAllUsersNotes();

        return redirect()
            ->route('home')
            ->with('success', 'All Notes deleted with their comments.');
    }

    public function downloadText(NoteService $noteService, Request $request)
    {
        $noteService->downloadText($request);

        $filepath = '/var/www/storage/app/notes' . auth()->id() . '.txt';

        return response()->download($filepath, 'base txt_copy' . auth()->id())
            ->deleteFileAfterSend(true);
    }

    public function downloadExcel()
    {
        return Excel::download(new NoteExport(auth()->id()), 'notes' . auth()->id() . '.xlsx');
    }
}
