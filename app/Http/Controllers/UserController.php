<?php

namespace App\Http\Controllers;

use App\Mail\BirthCongratulation;
use App\Models\User;
use App\Models\Note;
use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function showAll()
    {
        $users = User::where('role', 'customer')->get();

        return view('admin.customerUsers', compact('users'));
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

    public function userStatus(Request $request)
    {
        User::where('id', $request->userId)->update(['is_active' => $request->status]);

        return redirect()
            ->route('admin')
            ->with('success', 'Status changed.');
    }

   
}
