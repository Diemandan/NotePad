<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Models\Comment;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAll()
    {
        $users = User::where('role', 'customer')->get();

        return view('layouts.admin', compact('users'));
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        Note::where('user_id', $id)->delete();
        Comment::where('user_id', $id)->delete();

        return redirect()
            ->route('admin')
            ->with('success', 'User deleted with notes and comments.');
    }
}
