<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::borrowers()->orderBy('lastname')->get();

        return view('master.users.userlist', [
            'users' => $users
        ]);
    }
}
