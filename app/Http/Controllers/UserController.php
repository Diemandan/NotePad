<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAll(UserRepository $userRepository)
    {
        $users = $userRepository->getUsers();

        return view('admin.customerUsers', compact('users'));
    }

    public function delete(UserRepository $userRepository, $id)
    {
        $userRepository->deleteUser($id);

        return redirect()
            ->route('admin')
            ->with('success', 'User deleted with notes and comments.');
    }

    public function changeUserStatus(UserRepository $userRepository, Request $request)
    {
        $userRepository->changeUserStatus($request);

        return redirect()
            ->route('admin')
            ->with('success', 'Status changed.');
    }
}
