<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Note;
use App\Models\User;

class UserRepository
{
    public function getUsers()
    {
        return User::where('role', 'customer')->get();
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        Note::where('user_id', $id)->delete();
        Comment::where('user_id', $id)->delete();
    }

    public function changeUserStatus($request)
    {
        User::where('id', $request->userId)->update(['is_active' => $request->status]);
    }
}
