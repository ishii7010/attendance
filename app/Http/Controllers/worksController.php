<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use Carbon\Carbon;

class worksController extends Controller
{
    public function create()
    {
        $user = \Auth::user();

        if ( $user->status == 1 )
        {
            $work = $user->works->last();
        }
        return view('work.create', compact('user', 'work'));
    }

    public function store()
    {
        $user = \Auth::user();
        $work = new Work;
        $work->user_id = $user->id;
        $work->start_time = Carbon::now();
        if ($work->save())
        {
            $user->update(['status' => 1]);
            return redirect('work/create');
        }
        else {
            return redirect('work/create');
        }
    }

    public function update(Request $request, Work $work)
    {
        $user = \Auth::user();
        $work->end_time = Carbon::now();
        if ($work->save())
        {
            $user->update(['status' => 0]);
            return redirect('work/create');
        }
        else {
            return redirect('work/create');
        }
    }
}
