<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Work;

class UsersController extends Controller
{
    public function show($id)
    {
        //eval(\Psy\sh());
        $user = User::findOrFail($id);
        $works = $user->works;
        return view('user.show', compact('user', 'works'));
    }
}
