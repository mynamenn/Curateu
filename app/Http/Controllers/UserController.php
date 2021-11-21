<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

    }

    public function show($username)
    {
        $user = User::with(['collections', 'role'])->where('username', $username)->firstOrFail();

        $collections = $user->collections()->orderBy('created_at', 'desc')->paginate(2);

        return view('profile', [
            'user' => $user,
            'collections' => $collections,
        ]);
    }
}
