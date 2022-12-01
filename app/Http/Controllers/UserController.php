<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAll()
    {
        $users = User::where('role', 'customer')->get();

        return view('layouts.admin', compact('users'));
    }
}
