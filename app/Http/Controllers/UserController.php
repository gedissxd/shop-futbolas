<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('dashboard.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard.users.edit', compact('user'));
    }
}
