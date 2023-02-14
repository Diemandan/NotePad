<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    private $cacheKey;

    public function __construct()
    {
        $this->cacheKey = Auth()->id() . '_' . 'allCustomerUsers';
    }

    public function getUsers()
    {
        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        } else {
            $users = User::where('role', 'customer')->get();
            Cache::set($this->cacheKey, $users, 600);
            return $users;
        }
    }

    public function deleteUser($id)
    {
        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);

        User::where('id', $id)->delete();
        Note::where('user_id', $id)->delete();
        Comment::where('user_id', $id)->delete();
    }

    public function changeUserStatus($request)
    {
        Cache::has($this->cacheKey) && Cache::forget($this->cacheKey);

        User::where('id', $request->userId)->update(['is_active' => $request->status]);
    }
}
