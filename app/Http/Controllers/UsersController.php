<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function show(Request $request, $id)
    {
        $user = User::first();
        return view('user.show', compact('user'));
    }
}
