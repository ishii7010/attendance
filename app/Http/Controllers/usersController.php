<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\User;
use App\Work;

class UsersController extends Controller
{
    public function show($id)
    {
        //eval(\Psy\sh());
        $user = User::findOrFail($id);
        $a = $user->works;
        //$works = $a->where('id', 1);

        $works = Work::from('works AS w1')
        ->select(
                'w1.id',
                'w1.work_time',
                'w1.start_time',
                'w1.end_time'
            )
        ->where('w1.user_id', $id)
        ->groupBy('w1.work_day')
        ->get();

        //$rest = $works->rest;

        return view('user.show', compact('user', 'works'));
    }
}
